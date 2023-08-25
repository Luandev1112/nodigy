<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\DataCenter;

use App\Services\HetznerApiService;

use App\Http\Resources\DataCenterResourceView;
use PhpParser\Node\Expr\FuncCall;

class DataCenterController extends BaseController
{
    public function getCountry(Request $request)
    {
        $allData = DataCenter::select('data_centers.*')
            ->where('sync_date','=',date('Y-m-d'))
            ->orderBy('data_centers.id','DESC')
            ->get();

        $service = new HetznerApiService;
        $apiResponse = $service->geHetznerApiData('locations');

        if(!empty($allData) && count($allData) > 0 && isset($apiResponse['locations']) && count($apiResponse['locations']) > 0)
        {
            $result=[];
            $uniqueCountryNames = [];
            foreach($allData as $row){
                $countryName = $row->country;
                if (!in_array($countryName, $uniqueCountryNames))
                {
                    foreach ($apiResponse['locations'] as $location) {
                        if ($location['country'] === $countryName) {
                            $result[] = $location;
                            $uniqueCountryNames[] = $countryName;
                            break;
                        }
                    }
                    $uniqueCountryNames[] = $countryName;
                }
            }
            return $this->sendResponse($result, 'List Successfully.');
        }else{
            return $this->sendError('data not found.');
        }
    }

    public function getServerLocations(Request $request) 
    {
        $service = new HetznerApiService;
        $apiResponse = $service->geHetznerApiData('locations');
        return $this->sendResponse($apiResponse, 'List Successfully.');

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