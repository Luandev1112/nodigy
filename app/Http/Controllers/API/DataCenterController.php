<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\DataCenter;
use App\Models\HetznerServerType;
use App\Models\HetznerServerTypePrice;
use App\Models\WizardSetting;

use App\Http\Resources\DataCenterResourceView;

use App\Services\HetznerApiService;


class DataCenterController extends BaseController
{
    public function getCountry(Request $request)
    {
        $rules=[
            'project_id'=>"required",
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{
            $allData = HetznerServerTypePrice::select('location')
                ->whereDate("created_at", "=",date("Y-m-d"))
                ->orderBy('location','ASC')
                ->groupBy('location')
                ->pluck('location','location')
                ->toArray();

            $service = new HetznerApiService;
            $apiResponse = $service->geHetznerApiData('locations');

            $wizardSetting = WizardSetting::where('project_id',$request->project_id)->first();
            if(empty($wizardSetting)){
                return $this->sendError('Error', ['error'=>'Wizard setting not found, Please try again'],404);
            }
            
            if(isset($wizardSetting->id) && !empty($allData) && count($allData) > 0 && isset($apiResponse['locations']) && count($apiResponse['locations']) > 0)
            {

                $result=[];
                $uniqueLocationIds = [];
                foreach ($apiResponse['locations'] as $location)
                {
                    if (in_array($location['name'], $allData))
                    {
                        $location_name = $location['name'];
                        $server=[];

                        $min_req_vcpus = $wizardSetting->min_req_vcpus;
                        $min_req_ram = $wizardSetting->min_req_ram;
                        $min_req_ssd = $wizardSetting->min_req_ssd;
                        $minServer = [];
                        if($min_req_vcpus >0 && $min_req_ram >0 && $min_req_ssd >0)
                        {
                            $minServer = $this->getServerPrice($min_req_vcpus,$min_req_ram,$min_req_ssd,$location_name,$uniqueLocationIds);
                            if(!empty($minServer)){
                                $minServer['type'] = 1;
                                $minServer['type_name'] = "minimum_required";
                                $server[] = $minServer;
                                $uniqueLocationIds[$minServer['id']] = $minServer['id'];
                            }
                        }

                        $recom_vcpus = $wizardSetting->recom_vcpus;
                        $recom_ram = $wizardSetting->recom_ram;
                        $recom_ssd = $wizardSetting->recom_ssd;
                        $recomServer = [];
                        if($recom_vcpus >0 && $recom_ram >0 && $recom_ssd >0)
                        {
                            $last_vcpus = (isset($minServer['id']))? $minServer['cores']:0;
                            $last_ram = (isset($minServer['id']))? $minServer['memory']:0;
                            $last_ssd = (isset($minServer['id']))? $minServer['disk']:0;

                            $recomServer = $this->getServerPrice($recom_vcpus,$recom_ram,$recom_ssd,$location_name,$uniqueLocationIds,$last_vcpus,$last_ram,$last_ssd);
                            if(!empty($recomServer)){
                                $recomServer['type'] = 2;
                                $recomServer['type_name'] = "recommended";
                                $server[] = $recomServer;
                                $uniqueLocationIds[$recomServer['id']] = $recomServer['id'];
                            }
                        }

                        $max_perf_vcpus = $wizardSetting->max_perf_vcpus;
                        $max_perf_ram = $wizardSetting->max_perf_ram;
                        $max_perf_ssd = $wizardSetting->max_perf_ssd;
                        $maxServer = [];
                        if($max_perf_vcpus >0 && $max_perf_ram >0 && $max_perf_ssd >0)
                        {
                            $last_vcpus = (isset($recomServer['id']))? $recomServer['cores']:0;
                            $last_ram = (isset($recomServer['id']))? $recomServer['memory']:0;
                            $last_ssd = (isset($recomServer['id']))? $recomServer['disk']:0;

                            $maxServer = $this->getServerPrice($max_perf_vcpus,$max_perf_ram,$max_perf_ssd,$location_name,$uniqueLocationIds,$last_ram,$last_ssd);
                            if(!empty($maxServer)){
                                $maxServer['type'] = 3;
                                $maxServer['type_name'] = "max_performance";
                                $server[] = $maxServer;
                                $uniqueLocationIds[$maxServer['id']] = $maxServer['id'];
                            }
                        }

                        $location['server'] = $server;
                        $result[] = $location;
                    }
                }
                return $this->sendResponse($result, 'List Successfully.');
            }else{
                return $this->sendError('data not found.');
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong. Please try again'],404);
    }

    public function getServerPrice($cores,$memory,$disk,$location_name, $uniqueLocationIds =[], $last_vcpus=0, $last_ram=0, $last_ssd=0)
    {
        $columeName = array(
            'hetzner_server_type_prices.id',
            'hetzner_server_type_prices.parent_id',
            'hetzner_server_type_prices.location',
            'hetzner_server_type_prices.price_hourly_net',
            'hetzner_server_type_prices.price_hourly_gross',
            'hetzner_server_type_prices.price_monthly_net',
            'hetzner_server_type_prices.price_monthly_gross',
            'hetzner_server_types.cores',
            'hetzner_server_types.memory',
            'hetzner_server_types.disk',
            'hetzner_server_types.server_type_id',
            'hetzner_server_types.name',
            'hetzner_server_types.storage_type',
            'hetzner_server_types.cpu_type',
            'hetzner_server_types.architecture',
        );
        $hetznerServerTypePrice = HetznerServerTypePrice::select($columeName)
            ->join('hetzner_server_types', 'hetzner_server_type_prices.parent_id', '=', 'hetzner_server_types.id')
            ->whereDate('hetzner_server_type_prices.created_at', date("Y-m-d"))
            ->where('cores', '>=', $cores)
            ->where('memory', '>=', $memory)
            ->where('disk', '>=', $disk)
            ->where('hetzner_server_type_prices.location', '=', $location_name)
            ->whereNotIn('hetzner_server_type_prices.id', $uniqueLocationIds)
            ->when($last_vcpus > 0, function ($query) use ($last_vcpus, $last_ram, $last_ssd) {
                return $query->where('cores', '>', $last_vcpus)
                    ->where('memory', '>', $last_ram)
                    ->where('disk', '>', $last_ssd);
            })
            ->orderBy('cores')
            ->orderBy('memory')
            ->orderBy('disk')
            ->groupBy('hetzner_server_type_prices.id')
            ->first();

        return (isset($hetznerServerTypePrice->id))? $hetznerServerTypePrice->toArray():[];
    }

    public function view(Request $request)
    {
        $rules=[
            'datacenter_server_id'=>"required",
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{
            $model = DataCenter::where('server_id',$request->datacenter_server_id)->orderBy('id', 'desc')->first();
            if(isset($model->id))
            {
                $dataCenterResource = new DataCenterResourceView($model);
                return $this->sendResponse($dataCenterResource, 'view Successfully.');
            }else{
                return $this->sendError('detail not found.');
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong. Please try again'],404);
    }
}