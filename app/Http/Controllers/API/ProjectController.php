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
            $dataCenterResource = new DataCenterResourceView($model->dataCenter);

            $responseData = [
                'wizard_setting' => $mainResource,
                'forta_setting' => $fortaSettingResource,
                'data_center' => $dataCenterResource,
            ];
            return $this->sendResponse($responseData, 'view Successfully.');
        }else{
            return $this->sendError('detail not found.');
        }
    }
}