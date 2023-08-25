<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\SupportedWallet;

use App\Http\Resources\SupportedWalletResource;

class SupportedWalletController extends BaseController
{
    public function index(Request $request)
    {
        $sqlQuery = SupportedWallet::select('supported_wallets.*',DB::raw("GROUP_CONCAT(networks.network_name) as network_name"))
            ->leftjoin("networks",DB::raw("FIND_IN_SET(networks.id,supported_wallets.network_id)"),">",DB::raw("'0'"))
            ->where('supported_wallets.supp_wallet_status',SupportedWallet::ACTIVE);

        $network_id = $request->get('network_id');
        if ($network_id !="") {
            $sqlQuery->whereRaw("FIND_IN_SET('$network_id', supported_wallets.network_id)");
        }

        $allData = $sqlQuery->orderBy('supported_wallets.supp_wallet_name','ASC')
            ->groupBy('supported_wallets.id')
            ->get();

        if(!empty($allData) && count($allData) > 0){
            return $this->sendResponse(SupportedWalletResource::collection($allData), 'List Successfully.');
        }else{
            return $this->sendError('data not found.');
        }
    }
}