<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\HetznerApiService;

class HetznerApiController extends BaseController
{
    public $service;

    public function __construct()
    {
        $this->service = new HetznerApiService;
    }
    public function getAllLocations(Request $request)
    {
        try {
            $apiResponse = $this->service->geHetznerApiData('locations');
            if(isset($apiResponse['locations']) && !empty($apiResponse['locations']))
            {
                return $this->sendResponse($apiResponse['locations'], 'List Successfully.');
            }else{
                return $this->sendError('Error',$apiResponse,201);
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . $e->getLine();
            Log::info("getAllLocations:".$message);
            return $this->sendError('Error', ['error'=>'Error get locations data. Please try again'],201);
        }
    }

    public function getAllDatacenters(Request $request)
    {
        try {
            $apiResponse = $this->service->geHetznerApiData('datacenters');
            if(isset($apiResponse['datacenters']) && !empty($apiResponse['datacenters']))
            {
                return $this->sendResponse($apiResponse['datacenters'], 'List Successfully.');
            }else{
                return $this->sendError('Error',$apiResponse,201);
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . $e->getLine();
            Log::info("getAllDatacenters:".$message);
            return $this->sendError('Error', ['error'=>'Error get datacenters data. Please try again'],201);
        }
    }

    public function getAllImages(Request $request)
    {
        try {
            $apiResponse = $this->service->geHetznerApiData('images');
            if(isset($apiResponse['images']) && !empty($apiResponse['images']))
            {
                return $this->sendResponse($apiResponse['images'], 'List Successfully.');
            }else{
                return $this->sendError('Error',$apiResponse,201);
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . $e->getLine();
            Log::info("getAllImages:".$message);
            return $this->sendError('Error', ['error'=>'Error get images data. Please try again'],201);
        }
    }

    public function getAllNetworks(Request $request)
    {
        try {
            $apiResponse = $this->service->geHetznerApiData('networks');
            if(isset($apiResponse['networks']) && !empty($apiResponse['networks']))
            {
                return $this->sendResponse($apiResponse['networks'], 'List Successfully.');
            }else{
                return $this->sendError('Error',$apiResponse,201);
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . $e->getLine();
            Log::info("getAllNetworks:".$message);
            return $this->sendError('Error', ['error'=>'Error get networks data. Please try again'],201);
        }
    }

    public function getAllPricing(Request $request)
    {
        try {
            $apiResponse = $this->service->geHetznerApiData('pricing');
            if(isset($apiResponse['pricing']) && !empty($apiResponse['pricing']))
            {
                return $this->sendResponse($apiResponse['pricing'], 'List Successfully.');
            }else{
                return $this->sendError('Error',$apiResponse,201);
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . $e->getLine();
            Log::info("getAllPricing:".$message);
            return $this->sendError('Error', ['error'=>'Error get pricing data. Please try again'],201);
        }
    }

    public function getAllVolumes(Request $request)
    {
        try {
            $apiResponse = $this->service->geHetznerApiData('volumes');
            if(isset($apiResponse['volumes']) && !empty($apiResponse['volumes']))
            {
                return $this->sendResponse($apiResponse['volumes'], 'List Successfully.');
            }else{
                return $this->sendError('Error',$apiResponse,201);
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . $e->getLine();
            Log::info("getAllVolumes:".$message);
            return $this->sendError('Error', ['error'=>'Error get volumes data. Please try again'],201);
        }
    }

    public function getAllIsos(Request $request)
    {
        try {
            $apiResponse = $this->service->geHetznerApiData('isos');
            if(isset($apiResponse['isos']) && !empty($apiResponse['isos']))
            {
                return $this->sendResponse($apiResponse['isos'], 'List Successfully.');
            }else{
                return $this->sendError('Error',$apiResponse,201);
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . $e->getLine();
            Log::info("getAllIsos:".$message);
            return $this->sendError('Error', ['error'=>'Error get isos data. Please try again'],201);
        }
    }

    public function getAllServerTypes(Request $request)
    {
        try {
            $apiResponse = $this->service->geHetznerApiData('server_types');
            if(isset($apiResponse['server_types']) && !empty($apiResponse['server_types']))
            {
                return $this->sendResponse($apiResponse['server_types'], 'List Successfully.');
            }else{
                return $this->sendError('Error',$apiResponse,201);
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . $e->getLine();
            Log::info("getAllServerTypes:".$message);
            return $this->sendError('Error', ['error'=>'Error get server types data. Please try again'],201);
        }
    }

    public function getAllPlacementGroups(Request $request)
    {
        try {
            $apiResponse = $this->service->geHetznerApiData('placement_groups');
            if(isset($apiResponse['placement_groups']) && !empty($apiResponse['placement_groups']))
            {
                return $this->sendResponse($apiResponse['placement_groups'], 'List Successfully.');
            }else{
                return $this->sendError('Error',$apiResponse,201);
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . $e->getLine();
            Log::info("getAllPlacementGroups:".$message);
            return $this->sendError('Error', ['error'=>'Error get placement groups data. Please try again'],201);
        }
    }

    public function getText($value)
    {
        $text = preg_replace("/[^A-Za-z]/", "", $string);
        return $text;
    }

    public function getProjectServers(Request $request, $name)
    {
        $setting = null;
        $project = Project::where('project_name', $name);
        $project_servers = array();
        try {
            $apiResponse = $this->service->geHetznerApiData('server_types');
            if(isset($apiResponse['server_types']) && !empty($apiResponse['server_types']))
            {
                $servers = $apiResponse['server_types'];
                if($project->count() > 0)
                {
                    $wizardSetting = $project->first()->wizardSetting();
                    if($wizardSetting->count() > 0)
                    {
                        $setting = $wizardSetting->first();
                    }
                }
                if($setting)
                {
                    $cpu = '';
                    $count = 0;
                    foreach($servers as $server){
                        $cores = $server['cores'];
                        $memory = $server['memory'];
                        $disk = $server['disk'];
                        $price = $server['prices'][0]['price_monthly']['gross'];
                        if($setting->min_req_vcpus <= $cores && $setting->min_req_ram <= $memory && $setting->min_req_ssd <= $disk &&  $setting->min_req_price <= $price ){
                            if($cpu == ''){
                                $cpu = preg_replace("/[^A-Za-z]/", "", $server['name']);
                                $count = 1;
                            }else{
                                $new_cpu = preg_replace("/[^A-Za-z]/", "", $server['name']);
                                if($new_cpu == $cpu){
                                    $count++;
                                }else{
                                    $count = 1;
                                    $cpu = $new_cpu;
                                }
                            }
                            if($count <= 2){
                                array_push($project_servers, $server);
                            }
                        }

                    }
                }
                return $this->sendResponse($project_servers, 'List Successfully.');
            }else{
                return $this->sendError('Error',$apiResponse,201);
            }
        } catch (Exception $e) {
            $message = $e->getMessage() . $e->getLine();
            Log::info("getAllServerTypes:".$message);
            return $this->sendError('Error', ['error'=>'Error get server types data. Please try again'],201);
        }
    }
}