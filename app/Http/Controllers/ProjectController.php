<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;
use App\Models\BlockChain;

class ProjectController extends Controller
{
    public function index()
    {
        $loginUser = Auth::user();
        if(isset($loginUser->id) && $loginUser->id){
            return view('project.dynamic_index');
        }
        return view('project.index');
    }

    public function getlist(Request $request)
    {
        if ($request->ajax()) {

            $status = Project::$status;
            $chainType = BlockChain::$chainType;

            $sqlQuery = Project::select('project.*','networks.network_name','chains.chain_name','chains.chain_type',DB::raw("GROUP_CONCAT(supported_wallets.supp_wallet_name) as supp_wallet_name"))
                ->Join('networks', 'project.network_id', '=', 'networks.id')
                ->leftJoin('chains', 'project.chain_id', '=', 'chains.id')
                ->leftjoin("supported_wallets",DB::raw("FIND_IN_SET(supported_wallets.id,project.supp_wallet_id)"),">",DB::raw("'0'"))
                ->where('project.project_status',Project::ACTIVE);

            $pro_search = $request->input('pro_search');
            if (!empty($pro_search) && $pro_search) {
                $sqlQuery->where(function($query) use ($pro_search) {
                        $query->where('networks.network_name', 'LIKE', '%' . $pro_search . '%')
                            ->orWhere('project.project_name', 'LIKE', '%' . $pro_search . '%')
                            ->orWhere('chains.chain_name', 'LIKE', '%' . $pro_search . '%');
                    });
            }
            $filter_chain_type = $request->input('filter_chain_type');
            if( (isset($filter_chain_type) && !empty($filter_chain_type) && $filter_chain_type) ){
                $filter_chain_type = ($filter_chain_type=='testnet')? 1:0;
                $sqlQuery->where('chains.chain_type','=',$filter_chain_type);
            }

            $sort_type = $request->input('sort_type');// a-z = z-a
            $sort_by = (isset($sort_type) && $sort_type) ? "project.project_name":"project.id";

            $sort_type = (isset($sort_type) && $sort_type=="a-z") ? "ASC":"DESC";

            $allData = $sqlQuery->orderBy($sort_by,$sort_type)
                ->groupBy('project.id')
                ->get();

            if(!empty($allData) && count($allData) > 0)
            {
                $html = view('project.project_list',compact('allData','chainType'))->render();
                $result = ['status' => true, 'html' => $html];
            }else{
                $result = ['status' => false, 'html' =>""];
            }
            return response()->json($result);
        }
    }
}
