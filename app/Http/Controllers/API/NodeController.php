<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Exception;

use App\Models\User;
use App\Models\Node;

use App\Http\Resources\NodeResource;

class NodeController extends BaseController
{
    public function __construct()
    {
    }

    public function update(Request $request)
    {
        $rules=[
            'node_id'=>"required|numeric",
            'node_name'=>"nullable|string|max:100",
            'node_url'=>"nullable|string|max:500",
            'node_logo'=>"nullable|mimes:jpeg,png,jpg,svg",
            'server_id'=>"nullable|numeric",
            'user_wallet_id'=>"nullable|numeric",
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{

            $loginUser = $request->user;
            if(empty($loginUser)){
                return $this->sendError('Error', ['error'=>'User not found, Please try again'],404);
            }

            $nodeId = $request->node_id;
            $node = Node::where('id',$nodeId)->first();
            if(empty($node))
            {
                return $this->sendError('Error', ['error'=>'Node details not found, Please try again'],404);
            }

            try {
                DB::beginTransaction();

                if(!empty($request->server_id) && $request->server_id){
                    $node->server_id = $request->server_id;
                }
                if(!empty($request->user_wallet_id) && $request->user_wallet_id){
                    $node->user_wallet_id = $request->user_wallet_id;
                }
                if(!empty($request->node_name) && $request->node_name){
                    $node->node_name = $request->node_name;
                }
                if(!empty($request->node_url) && $request->node_url){
                    $node->node_url = $request->node_url;
                }
                if ($request->hasFile('node_logo') && $request->node_logo)
                {
                    $dir = "public/node_logo/";
                    if($node->node_logo) {
                        if(Storage::disk('local')->exists($dir . $node->node_logo)) {
                            Storage::delete($dir . $node->node_logo);
                        }
                    }
                    $extension = $request->file("node_logo")->getClientOriginalExtension();
                    $filename = "node_img_".uniqid() . "_" . time() . "." . $extension;
                    Storage::disk("local")->put($dir . $filename,File::get($request->file("node_logo")));

                    $node->node_logo = $filename;
                }

                if(!$node->save()){
                    throw new Exception("Save data error");
                }else{
                    DB::commit();

                    $resource = new NodeResource($node);
                    return $this->sendResponse($resource, 'Data saved successfully.');
                }
            } catch (Exception $e) {
                DB::rollBack();
                $message = $e->getMessage() . $e->getLine();
                Log::info("node-update:".$message);
                return $this->sendError('Error', ['error'=>'Error saving data. Please try again'],201);
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong. Please try again'],404);
    }
}
