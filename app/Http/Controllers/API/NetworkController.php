<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;

use App\Models\Network;

use App\Http\Resources\NetworkResource;

class NetworkController extends BaseController
{
    public function index(Request $request)
    {
        $allData = Network::select('networks.*')
            ->where('networks.network_status',Network::ACTIVE)
            ->orderBy('networks.network_name','ASC')
            ->groupBy('networks.id')
            ->get();
        if(!empty($allData) && count($allData) > 0){
            return $this->sendResponse(NetworkResource::collection($allData), 'List Successfully.');
        }else{
            return $this->sendError('data not found.');
        }
    }
}