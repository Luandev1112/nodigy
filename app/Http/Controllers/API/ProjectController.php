<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Project;
use App\Models\WizardSetting;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectResourceView;
use App\Http\Resources\WizardSettingResourceView;
use App\Http\Resources\WizardSettingStepResourceView;
use App\Http\Resources\DataCenterResourceView;

class ProjectController extends BaseController
{
    public function index(Request $request)
    {
        $sqlQuery = Project::select('project.*','networks.network_name','chains.chain_name',DB::raw("GROUP_CONCAT(supported_wallets.supp_wallet_name) as supp_wallet_name"))
            ->leftJoin('networks', 'project.network_id', '=', 'networks.id')
            ->leftJoin('chains', 'project.chain_id', '=', 'chains.id')
            ->leftjoin("supported_wallets",DB::raw("FIND_IN_SET(supported_wallets.id,project.supp_wallet_id)"),">",DB::raw("'0'"))
            ->where('project.project_status',Project::ACTIVE);

        $network_id = $request->get('network_id');
        if ($network_id !="") {
            $sqlQuery->where('project.network_id', '=',$network_id);
        }

        $chain_id = $request->get('chain_id');
        if ($chain_id !="") {
            $sqlQuery->where('project.chain_id', '=',$chain_id);
        }

        $supp_wallet_id = $request->get('supp_wallet_id');
        if ($supp_wallet_id !="") {
            $sqlQuery->whereRaw("FIND_IN_SET('$supp_wallet_id', project.supp_wallet_id)");
        }

        $allData = $sqlQuery->orderBy('project.project_name','ASC')
            ->groupBy('project.id')
            ->get();

        if(!empty($allData) && count($allData) > 0){
            return $this->sendResponse(ProjectResource::collection($allData), 'List Successfully.');
        }else{
            return $this->sendError('data not found.');
        }
    }

    public function view($id)
    {
        $model = Project::select('project.*','networks.network_name','chains.chain_name',DB::raw("GROUP_CONCAT(supported_wallets.supp_wallet_name) as supp_wallet_name"))
            ->leftJoin('networks', 'project.network_id', '=', 'networks.id')
            ->leftJoin('chains', 'project.chain_id', '=', 'chains.id')
            ->leftjoin("supported_wallets",DB::raw("FIND_IN_SET(supported_wallets.id,project.supp_wallet_id)"),">",DB::raw("'0'"))
            ->where('project.project_status',Project::ACTIVE)
            ->where('project.id',$id)
            ->groupBy('project.id')
            ->first();

        if(isset($model->id)){
            $resource = new ProjectResourceView($model);
            return $this->sendResponse($resource, 'view Successfully.');
        }else{
            return $this->sendError('detail not found.');
        }
    }

    public function wizardSettingView($id)
    {
        $model = WizardSetting::where('project_id',$id)->first();
        if(isset($model->id))
        {
            $mainResource = new WizardSettingResourceView($model);
            $fortaSettingResource = ($model->project_id==3)? new WizardSettingStepResourceView($model):[];

            $responseData = [
                'wizard_setting' => $mainResource,
                'forta_setting' => $fortaSettingResource,
            ];
            return $this->sendResponse($responseData, 'view Successfully.');
        }else{
            return $this->sendError('detail not found.');
        }
    }

    public function getNodeProjects(Request $request)
    {
        $cond = array();
        $cond['project_status'] = 1;
        $projects = Project::where($cond)->get();
        $project_array = array();
        if($projects->count() > 0)
        {
            foreach($projects as $key => $project)
            {
                $nodes_count = $project->nodes()->where('node_status', 1)->count();
                if($nodes_count > 0)
                {
                    $project->nodes_count = $nodes_count;
                    array_push($project_array, $project);
                }
            }
        }
        $data = array();
        $data['project_list'] = $project_array;
        return $this->sendResponse($data, 'success');
    }

    public function getProjectDetail($name)
    {
        try {
            $data = array();
            $project_cond['project_name'] = $name;
            $project = Project::where($project_cond);
            if($project->count() > 0){
                $data['project'] = $project->first();
                $data['status'] = 1;
            }else{
                $data['project'] = null;
                $data['status'] = 0;
            }
        return response()->json($data, 200);
        } catch (\Throwable $th) {
            return $this->sendError('detail not found.');
        }
    }

}