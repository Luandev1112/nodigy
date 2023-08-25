<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;

use App\Models\BlockChain;

use App\Http\Resources\BlockChainResource;

class BlockChainController extends BaseController
{
    public function index(Request $request)
    {
        $sqlQuery = BlockChain::select('chains.*','networks.network_name')
            ->leftJoin('networks', 'chains.network_id', '=', 'networks.id')
            ->where('chains.chain_status',BlockChain::ACTIVE);

        $network_id = $request->get('network_id');
        if ($network_id !="") {
            $sqlQuery->where('chains.network_id', '=',$network_id);
        }

        $allData = $sqlQuery->orderBy('chains.chain_name','ASC')
            ->groupBy('chains.id')
            ->get();

        if(!empty($allData) && count($allData) > 0){
            return $this->sendResponse(BlockChainResource::collection($allData), 'List Successfully.');
        }else{
            return $this->sendError('data not found.');
        }
    }
}