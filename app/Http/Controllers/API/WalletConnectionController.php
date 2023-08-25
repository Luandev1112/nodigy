<?php

namespace App\Http\Controllers\API;
use App\Models\Network;
use App\Models\SupportedWallet;
use App\Models\UserWallet;
use App\User;
use App\Models\Project;
use App\Models\Server;
use App\Models\UserTransaction;
use App\Models\Node;
use App\Models\Chain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class WalletConnectionController extends BaseController
{
    public function getAllProjects(Request $request)
    {
        $result = array();
        $projects = Project::where('project_status', 1)->get();
        $result['projectlist'] = array();
        if($projects->count() > 0){
            foreach($projects as $project) {
                $network = $project->network()->first();
                $chain = $project->chain()->first();
                $project_data = array(
                    'id' => $project->id,
                    'project_name' => $project->project_name,
                    'image' => $project->image,
                    'type' => $project->network_type,
                    'min_stake' => $project->min_stake . " " . $project->stake_unit,
                    'min_price' => "$ ".$project->min_price,
                    'setup_fee' => $project->onbording_fee,
                    'description' => $project->description,
                    'network_id' => $network->id,
                    'network_name' => $network->network_name,
                    'chain_id' => $chain->id,
                    'chain_name' => $chain->chain_name,
                    'readmore' => true
                );
                array_push($result['projectlist'], $project_data);
            }
        }
        return response()->json($result, 200);
    }

    public function filterNetworkProjects(Request $request)
    {
        $result = array();
        $result['projectlist'] = array();
        $cond = array();
        if($request->network_type == 'main') {
            $cond['network_type'] = 1;
        }else if($request->network_type == 'test') {
            $cond['network_type'] = 0;
        }
        $cond['project_status'] = 1;
        $projects = Project::where($cond)->get();
        if($projects->count() > 0) {
            foreach($projects as $project) {
                $network = $project->network()->first();
                $chain = $project->chain()->first();
                $project_data = array(
                    'id' => $project->id,
                    'project_name' => $project->project_name,
                    'image' => $project->image,
                    'type' => $project->network_type,
                    'min_stake' => $project->min_stake . " " . $project->stake_unit,
                    'min_price' => "$ ".$project->min_price,
                    'setup_fee' => $project->onbording_fee,
                    'description' => $project->description,
                    'network_id' => $network->id,
                    'network_name' => $network->network_name,
                    'chain_id' => $chain->id,
                    'chain_name' => $chain->chain_name,
                    'readmore' => true
                );
                array_push($result['projectlist'], $project_data);
            }
        }
        return response()->json($result, 200);
    }

    public function getAllServers(Request $request) {
        $servers = Server::all();
        return response()->json($servers, 200);
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
        $user = Auth::user();
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

    public function cardPayment(Request $request)
    {
        $result = array();
        $card_number = $request->card_number;
        $card_holder = $request->card_holder;
        $expiration_date = $request->expiration_date;
        $cvv = $request->cvv;
        $amount_from = $request->amount_from;
        $amount_to = $request->amount_to;
        // handle card payment
        // ...
        $user = Auth::user();
        $user->balance += $amount_to;
        $user->save();
        $result['status'] = "success";
        $result['user'] = $user;
        return response()->json($result, 200);
    }

    public function userTransaction(Request $request)
    {
        $result = array();
        $user = Auth::user();
        $user_id = $user->id;
        $transactions = UserTransaction::where('user_id', $user_id)->orderBy('date', 'DESC')->get();
        $transaction_arr = array();
        if($transactions->count() > 0){
            foreach($transactions as $transaction) {
                $transaction_data = array();
                $formated_date = Carbon::createFromTimestamp($transaction->date/1000)->format('Y-m-d H:i:s');
                $transaction_data['date'] = Carbon::parse($formated_date)->diffForHumans();
                $transaction_data['amount'] = $transaction->amount;
                $transaction_data['purpose'] = $transaction->purpose;
                $transaction_data['txnHash'] = $transaction->txn_id;
                if($transaction->project()->count() > 0) {
                    $transaction_data['project_name'] = $transaction->project()->first()->project_name;
                    $transaction_data['project_logo'] = $transaction->project()->first()->image;
                }else{
                    $transaction_data['project_name'] = '-';
                    $transaction_data['project_logo'] = '-';
                }

                if($transaction->server()->count() > 0) {
                    $transaction_data['server_name'] = $transaction->server()->first()->server_name;
                }else{
                    $transaction_data['server_name'] = '-';
                }
                $status = '';
                $statusClass = '';
                switch($transaction->status){
                    case 1:
                        $status = "Success";
                        $statusClass = "successtext";
                    break;
                    case 2:
                        $status = "Failed";
                        $statusClass = "failedtext";
                    break;
                    case 3:
                        $status = "Invoice";
                        $statusClass = "invoicetext";
                    break;
                }
                $transaction_data['status'] = $status;
                $transaction_data['statusClass'] = $statusClass;
                array_push($transaction_arr, $transaction_data);
            }
        }
        $result['transaction_array'] = $transaction_arr;
        $result['total_payment'] = 0;
        return response()->json($result, 200);
    }

    public function purchaseServer(Request $request)
    {
        $data = array();
        $user = Auth::user();
        $server_id = $request->server_id;
        $project_id = $request->project_id;
        $date = time() * 1000;

        $server = Server::findOrFail($server_id);
        $monthly_fee = $server->monthly_price;
        $project = Project::findOrFail($project_id);
        $onbording_fee = $project->onbording_fee;

        $transaction_data = array();
        $transaction_data['project_id'] = $project_id;
        $transaction_data['server_id'] = $server_id;
        $transaction_data['user_id'] = $user->id;
        $transaction_data['date'] = $date;
        $transaction_data['amount'] = $monthly_fee + $onbording_fee;
        $transaction_data['purpose'] = "Purchase one-time onbording fee and monthly and server monthly payment";

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

    public function getWalletList(Request $request)
    {
        $wallet_list = SupportedWallet::where('supp_wallet_status', 1)->get();
        $user = Auth::user();
        $wallets = array();
        $data = array();
        foreach($wallet_list as $wallet)
        {
            $network = $wallet->network()->first();
            $userwallet_cond = array();
            $userwallet_cond['user_id'] = $user->id;
            $userwallet_cond['wallet_id'] = $wallet->id;
            $user_wallet = UserWallet::where($userwallet_cond)->first();
            $wallet_address = null;
            $user_wallet_id = 0;
            if ($user_wallet != null){
                $wallet_address = $user_wallet->address;
                $user_wallet_id = $user_wallet->id;
            }
            $wallet_data = array(
                'id' => $wallet->id,
                'network_id' => $network->id,
                'network_name' => $network->network_name,
                'wallet_address' => $wallet_address,
                'image' => $wallet->wallet_logo,
                'user_wallet_id' => $user_wallet_id,
                'wallet_name' => $wallet->supp_wallet_name
            );
            array_push($wallets, $wallet_data);
        }
        $data['wallets'] = $wallets;
        return response()->json($data, 200);
    }

    public function getChainlist(Request $request)
    {
        $chains = Chain::where('chain_status', 1)->get();
        $data = array();
        $data['chains'] = $chains;
        return response()->json($data, 200);
    }

    public function getInitialNode(Request $request)
    {
        $data = array();
        $user = Auth::user();
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

    public function createNode(Request $request)
    {
        $data = array();
        $project_id = $request->project_id;
        $server_id = $request->server_id;
        $user_wallet_id = $request->user_wallet_id;
        $node_name = $request->node_name;
        $node_logo = $request->node_logo;
        $node_type = $request->node_type;

        $project = Project::findOrFail($project_id);

        $user = Auth::user();
        $nodecond = array();
        $nodecond['user_id'] = $user->id;
        $nodecond['project_id'] = $project_id;
        $nodecond['server_id'] = $server_id;

        $nodes = Node::where($nodecond)->get();
        if($nodes->count() > 0) {
            $node = $nodes[0];
            $node->user_wallet_id = $user_wallet_id;
            $node->node_name = $node_name;
            $node->node_logo = $node_logo;
            $node->node_type = $node_type;
            $node->node_status = 1;
            $node->save();
            $data['result'] = 1;
            $data['node'] = $node;
        } else {
            $data['result'] = 0;
        }
        return response()->json($data, 200);
    }

    public function checkeInstalledWallets(Request $request) {
        $data = array();
        $user = Auth::user();
        $user_wallets = UserWallet::where('user_id', $user->id)->get();
        if($user_wallets->count() > 0){
            $data['result'] = 1;
            $data['user_wallets'] = $user_wallets;
        } else {
            $data['result'] = 0;
        }
        return response()->json($data, 200);
    }

    public function editUserWallet(Request $request)
    {
        $wallet_name = $request->wallet_name;
        $wallet_id = $request->wallet_id;
        $wallet=UserWallet::findOrFail($wallet_id);
        if($wallet) {
            $wallet->wallet_name = $wallet_name;
            $wallet->save();
        }
        return response()->json($wallet, 200);

    }
}
