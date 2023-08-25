<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;

use App\Models\User;
use App\Models\WizardSettingNym;
use App\Models\NymNodeLog;
use App\Models\DataCenter;
use App\Models\WizardSetting;

use App\Http\Resources\WizardSettingNymResource;

use App\Services\HetznerApiService;

class WizardSettingNymController extends BaseController
{
    public $service;

    public function __construct()
    {
        $this->service = new HetznerApiService;
    }

    public function store(Request $request)
    {
        $rules=[
            'project_id'=>"required|numeric",
            'node_id'=>"required|numeric",
            'wallet'=>"nullable",
            'server_id'=>"nullable|numeric",
            'data_center_id'=>"nullable|numeric",
            'data_center_type'=>"nullable|string|max:255",
            'country'=>"nullable|string|max:255",
            'city'=>"nullable|string|max:255",
            'node_key'=>"nullable|string|max:255",
            'signature_first_key'=>"nullable|string|max:255",
            'signature_second_key'=>"nullable|string|max:255",
            'sphinx_key'=>"nullable|string|max:255",
            'progress_status'=>"nullable|numeric",
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{

            $loginUser = $request->user;
            if(empty($loginUser)){
                return $this->sendError('Error', ['error'=>'User not found, Please try again'],404);
            }

            try {
                DB::beginTransaction();

                $model = WizardSettingNym::updateOrCreate(
                    [
                        'project_id' => $request->project_id,
                        'user_id' => $loginUser->id,
                        'node_id' => $request->node_id,
                    ],
                    array_filter([
                        'server_id' => $request->server_id,
                        'data_center_id' => $request->data_center_id,
                        'data_center_type' => $request->data_center_type,
                        'country' => $request->country,
                        'city' => $request->city,
                        'node_key' => $request->node_key,
                        'signature_first_key' => $request->signature_first_key,
                        'signature_second_key' => $request->signature_second_key,
                        'sphinx_key' => $request->sphinx_key,
                        'host_bind_address' => $request->host_bind_address,
                        'version' => $request->version,
                        'mix_port' => $request->mix_port,
                        'verloc_port' => $request->verloc_port,
                        'http_port' => $request->http_port,
                        'installation_json' => $request->installation_json,
                        'step_description' => $request->step_description,
                        'installation_log' => $request->installation_log,
                        'progress_status' => ($request->progress_status>0)? $request->progress_status:1,
                    ])
                );

                if(!$model){
                    throw new Exception("Save data error");
                }else{
                    DB::commit();
                    $resource = new WizardSettingNymResource($model);
                    return $this->sendResponse($resource, 'Data saved successfully.');
                }
            } catch (Exception $e) {
                DB::rollBack();
                $message = $e->getMessage() . $e->getLine();
                Log::info("WizardSettingNym:".$message);
                return $this->sendError('Error', ['error'=>'Error saving data. Please try again'],201);
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong. Please try again'],404);
    }
    public function view(Request $request)
    {
        $rules=[
            'project_id'=>"required|integer",
            'node_id'=>"required|integer",
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{

            $loginUser = $request->user;
            if(empty($loginUser)){
                return $this->sendError('Error', ['error'=>'User not found, Please try again'],404);
            }

            try {
                $model = WizardSettingNym::where('project_id',$request->project_id)
                    ->where('node_id',$request->node_id)
                    ->where('user_id',$loginUser->id)
                    ->first();

                    if(isset($model->id)){
                    $resource = new WizardSettingNymResource($model);
                    return $this->sendResponse($resource, 'view Successfully.');
                }else{
                    return $this->sendError('detail not found.');
                }
            } catch (Exception $e) {
                $message = $e->getMessage() . $e->getLine();
                Log::info("nym-view-log:".$message);
                return $this->sendError('Error', ['error'=>'Error saving data. Please try again'],201);
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong. Please try again'],404);
    }

    public function createServer(Request $request)
    {
        $rules=[
            'project_id'=>"required|integer",
            'node_id'=>"required|integer",
            'location_id'=>"required|integer",
            'wizard_setting_id'=>"required|integer",
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{

            $loginUser = $request->user;
            if(empty($loginUser)){
                return $this->sendError('Error', ['error'=>'User not found, Please try again'],404);
            }

            try {

                if(!$loginUser->ssh_key_id){
                    $apiResponse = $this->service->createSshKey($loginUser->id);

                    NymNodeLog::create(['node_id'=>$request->node_id,'response_json'=>json_encode($apiResponse)]);

                    if(isset($apiResponse['ssh_key']['id']) && $apiResponse['ssh_key']['id']){
                        $loginUser->ssh_key_id = $apiResponse['ssh_key']['id'];
                        $loginUser->ssh_public_key = (isset($apiResponse['ssh_key']['public_key']))? $apiResponse['ssh_key']['public_key']:"";
                        $loginUser->save();
                    }
                }

                $wizardSettingNym = WizardSettingNym::where('project_id',$request->project_id)
                    ->where('node_id',$request->node_id)
                    ->where('user_id',$loginUser->id)
                    ->first();
                if(empty($wizardSettingNym)){
                    return $this->sendError('Error', ['error'=>'WizardSettingNym log not found, Please try again'],404);
                }

                $wizardSetting = WizardSetting::where('id',$request->wizard_setting_id)->first();
                if(empty($wizardSetting)){
                    return $this->sendError('Error', ['error'=>'Wizard setting not found, Please try again'],404);
                }

                $dataCenter = DataCenter::where('server_id',$wizardSetting->datacenter_server_id)->orderBy('id', 'desc')->first();
                $serverLog = (isset($dataCenter->id) && $dataCenter->api_log)? json_decode($dataCenter->api_log,true):[];
                $image_name = (isset($serverLog['image']['name']) && $serverLog['image']['name'])? $serverLog['image']['name']:"";
                $server_type_id = (isset($serverLog['server_type']['id']) && $serverLog['server_type']['id'])? $serverLog['server_type']['id']:"";

                $serverName = Str::slug("NYM-SERVER-".$loginUser->id, '-') . '-' . time();

                $uniqueKey = 'user-nym-' . $loginUser->id;
                $serverData = [
                    "location" => ($request->location_id)? $request->location_id:"",
                    "image" => $image_name,
                    "name" => $serverName,
                    "ssh_keys" => [$uniqueKey],
                    "start_after_create" => true,
                    /* "public_net" => [
                        "enable_ipv4" => false,
                        "enable_ipv6" => false,
                        "ipv4" => null,
                        "ipv6" => null,
                    ], */
                    "server_type" => ($server_type_id !== null) ? (string)$server_type_id : "1",
                    //"placement_group" => 27476,
                    //"networks" => 1591306,
                ];
                $apiResponse = $this->service->createServer($serverData);

                $wizardSettingNym->installation_json = ($serverData)? json_encode($serverData):"";
                $wizardSettingNym->installation_log = ($apiResponse)? json_encode($apiResponse):"";
                $wizardSettingNym->save();

                NymNodeLog::create(['node_id'=>$request->node_id,'response_json'=>json_encode($apiResponse)]);

                if(isset($apiResponse['status']) && in_array($apiResponse['status'],['running','initializing']))
                {
                    return $this->sendResponse($apiResponse, 'create server successfully.');
                }else{
                    return $this->sendError('Error',$apiResponse,201);
                }

            } catch (Exception $e) {
                $message = $e->getMessage() . $e->getLine();
                Log::info("createServer:".$message);
                return $this->sendError('Error', ['error'=>'Error create server. Please try again'],201);
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong. Please try again'],404);
    }

    public function deleteServer(Request $request)
    {
        $rules=[
            'server_id'=>"required|integer",
            'project_id'=>"required|integer",
            'node_id'=>"required|integer",
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{

            $loginUser = $request->user;
            if(empty($loginUser)){
                return $this->sendError('Error', ['error'=>'User not found, Please try again'],404);
            }

            try {
                $model = WizardSettingNym::where('project_id',$request->project_id)
                    ->where('node_id',$request->node_id)
                    ->where('server_id',$request->server_id)
                    ->where('user_id',$loginUser->id)
                    ->first();

                if(empty($model)){
                    return $this->sendError('Error', ['error'=>'Server not found, Please try again'],404);
                }

                $service = new HetznerApiService;
                $apiResponse = $service->removeServer($request->server_id);

                NymNodeLog::create(['node_id'=>$request->node_id,'response_json'=>json_encode($apiResponse)]);

                if(isset($apiResponse['action']['id']) && $apiResponse['action']['id'])
                {
                    return $this->sendResponse($apiResponse, 'server delete successfully.');
                }else{
                    return $this->sendError('Error',$apiResponse,201);
                }

            } catch (Exception $e) {
                $message = $e->getMessage() . $e->getLine();
                Log::info("deleteServer:".$message);
                return $this->sendError('Error', ['error'=>'Error saving data. Please try again'],201);
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong. Please try again'],404);
    }

    public function viewServer(Request $request)
    {
        $rules=[
            'server_id'=>"required|integer",
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{

            $loginUser = $request->user;
            if(empty($loginUser)){
                return $this->sendError('Error', ['error'=>'User not found, Please try again'],404);
            }

            try {
                $apiResponse = $this->service->viewServer($request->server_id);
                if(isset($apiResponse['server']) && !empty($apiResponse['server']))
                {
                    return $this->sendResponse($apiResponse['server'], 'View Successfully.');
                }else{
                    return $this->sendError('Error',$apiResponse,201);
                }
            } catch (Exception $e) {
                $message = $e->getMessage() . $e->getLine();
                Log::info("viewServer:".$message);
                return $this->sendError('Error', ['error'=>'Error get server data. Please try again'],201);
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong. Please try again'],404);
    }

    public function nodeInstallationStart(Request $request)
    {
        $rules=[
            'node_id'=>"required",
            'project_id'=>"required",
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{

            $loginUser = $request->user;
            if(empty($loginUser)){
                return $this->sendError('Error', ['error'=>'User not found, Please try again'],404);
            }

            try {

                $host = '23.88.49.33'; // Replace with your server's IP or hostname
                $username = 'user-nym-' . $loginUser->id; // Replace with your SSH username

                $path = storage_path('app/hetzner-keys/' . $username);
                $privateKeyPath = $path . "/id_rsa.pub"; // Path to your private key
                $publicKey = file_get_contents($privateKeyPath);

                if (env('HETZNER_TYPE') == "local") {
                    $scriptPath = 'wget -O NYM-mainnet-install.sh  http://23.88.49.33/NYM-mainnet-install.sh  && chmod +x NYM-mainnet-install.sh  && ./NYM-mainnet-install.sh';
                } else {
                    $scriptPath = '/var/www/html/automation/nym/NYM-mainnet-install.sh';
                }

                //$output = exec($scriptPath);
                //pr($output);

                return $this->sendResponse([], 'Node Installation Start Successfully.');
            } catch (Exception $e) {
                $message = $e->getMessage() . $e->getLine();
                Log::info("viewServer:".$message);
                return $this->sendError('Error', ['error'=>'Error get server data. Please try again'],201);
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong. Please try again'],404);
    }
}