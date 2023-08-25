<?php

namespace App\Http\Controllers\API;
use App\Models\Network;
use App\Models\SupportedWallet;
use App\Models\UserWallet;
use App\Models\User;
use App\Models\Project;
use App\Models\Server;
use App\Models\UserTransaction;
use App\Models\Node;
use App\Models\Chain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class NYMController extends BaseController
{    
    public function getInitialNode(Request $request)
    {
        $data = array();
        $user = User::findOrFail(1);
        $cond['user_id'] = $user->id;
        $cond['node_status'] = 0;
        $nodes = Node::where($cond)->get();
        if($nodes->count() > 0){
            $node = $nodes[0];
            $data['status'] = 1;
            $project_id = $node->project_id;
            if($project_id != null){
                $project = Project::findOrFail($project_id);
                $project->setup_fee = $project->onbording_fee;
                $data['project'] = $project;
            }
            $server_id = $node->server_id;
            if($server_id != null) {
                $server = Server::findOrFail($server_id);
                $data['server'] = $server;
            }
            $user_wallet_id = $node->user_wallet_id;
            if($user_wallet_id != null) {
                $user_wallet = UserWallet::findOrFail($user_wallet_id);
                if($user_wallet) {
                    $supp_wallet = $user_wallet->supportedWallet()->first();
                    $network = $supp_wallet->network()->first();
                    $wallet_data = array(
                        'id' => $supp_wallet->id,
                        'network_id' => $supp_wallet->network_id,
                        'network_name' => $network->network_name,
                        'wallet_address' => $user_wallet->address,
                        'image' => $supp_wallet->wallet_logo,
                        'user_wallet_id' => $user_wallet_id,
                        'wallet_name' => $supp_wallet->supp_wallet_name
                    );
                    $data['wallet'] = $wallet_data;
                }
            }
        } else {
            $data['status'] = 0;
        }
        return response()->json($data, 200); 
    }

    public function walletPayment(Request $request)
    {
        $result = array();
        $wallet_name = $request->wallet_name;
        $amount = $request->amount;
        $wallet_address = $request->wallet_address;
        $transaction_id = $request->transaction_id;
        $transaction_status = $request->success;
        $transaction_date = $request->date;
        // handle wallet payment
        $user = $request->user;
        $user->balance += $amount;
        $user->save();
        // add tranaction history
        $transaction_data = array();
        $transaction_data['date'] = date("Y-m-d H:i:s");
        $transaction_data['amount'] = $amount;
        $transaction_data['txn_id'] = $transaction_id;
        $transaction_data['status'] = $transaction_status;
        $transaction_data['date'] = $transaction_date;
        if($amount > 0) {
            $transaction_data['purpose'] = "Add funds";
        }else if($amount < 0) {
            $transaction_data['purpose'] = "Withdraw money";
        }
        $transaction_data['user_id'] = $user->id;
        $transaction_row = UserTransaction::create($transaction_data);

        $result['status'] = "success";
        $result['transaction'] = $transaction_data;
        $result['user'] = $user;
        return response()->json($result, 200);
    }

    public function purchaseServer(Request $request)
    {
        $data = array();
        $user = $request->user;
        $server_id = $request->server_id;
        $date = time() * 1000;

        $server = Server::findOrFail($server_id);
        $monthly_fee = $server->monthly_price;
        $project_cond['project_name'] = 'NYM';
        $project = Project::where($project_cond)->first();
        $onbording_fee = $project->onbording_fee;

        $transaction_data = array();
        $transaction_data['project_id'] = $project->id;
        $transaction_data['server_id'] = $server_id;
        $transaction_data['user_id'] = $user->id;
        $transaction_data['date'] = $date;
        $transaction_data['amount'] = $monthly_fee + $onbording_fee;
        $transaction_data['purpose'] = "Purchase one-time onbording fee and monthly and server monthly payment";
        $transaction_data['txn_id'] = time();

        // Save transaction data
        $usertransaction = UserTransaction::create($transaction_data);
        // Change User balance after set paid
        $user->balance = $user->balance - $transaction_data['amount'];
        $user->save();

        $node_data = array();
        $node_data['user_id'] = $user->id;
        $node_data['project_id'] = $project->id;
        $node_data['server_id'] = $server->id;
        // $node_data['setup_fee'] = $transaction_data['amount'];
        $node = Node::create($node_data);
        $data['transaction'] = $transaction_data;
        $data['user_balance'] = $user->balance;
        return response()->json($data, 200);
    }

    public function getTransaction(Request $request, $hashId)
    { 
        $transaction_cond['txn_id'] = $hashId;
        $transaction = UserTransaction::where($transaction_cond)->first();
        return response()->json($transaction, 200);
    }

    public function addWallet(Request $request)
    {
        $user = $request->user;
        $wallet_address = $request->wallet_address;
        $project_name = $request->project_name;
        $project_cond['project_name'] = $project_name;
        $project = Project::where($project_cond)->first();
        $node_cond = array();
        $node_cond['project_id'] = $project->id;
        $node_cond['user_id'] = $user->id;
        $node = Node::where($node_cond)->first();
        $node->description = $wallet_address;
        $node->save();
        return response()->json($node, 200);
    }

    public function getNodeWallet(Request $request)
    {
        $user = $request->user;
        $project_name = $request->project_name;
        $project_cond['project_name'] = $project_name;
        $project = Project::where($project_cond)->first();
        $node_cond = array();
        $node_cond['project_id'] = $project->id;
        $node_cond['user_id'] = $user->id;
        $node = Node::where($node_cond)->first();
        $result['wallet'] = $node->description;
        return response()->json($result, 200);
    }

}