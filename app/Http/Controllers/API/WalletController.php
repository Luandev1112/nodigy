<?php

namespace App\Http\Controllers\API;
use App\Models\Network;
use App\Models\SupportedWallet;
use App\Models\UserWallet;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class WalletController extends BaseController
{    
    public function getNetworks(Request $request)
    {
        $user = Auth::user();
        $networks = Network::where('network_status', 1)->get();
        foreach($networks as $network) {
            $cond['user_id'] = $user->id;
            $cond['network_id'] = $network->id;
            $user_wallets = UserWallet::where($cond)->get();
            $network->counts = $user_wallets->count();
        }
        return response()->json($networks, 200);
    }

    public function getNetworkWallets(Request $request, $network_id)
    {
        $cond = array();
        $cond['network_id'] = $network_id;
        $cond['supp_wallet_status'] = 1;
        $wallets = SupportedWallet::where($cond)->get();
        return response()->json($wallets, 200);
    }

    public function saveUserWallet(Request $request)
    {
        $user = Auth::user();
        $cond = array();
        $cond['user_id'] = $user->id;
        $cond['network_id'] = $request->network_id;
        $cond['wallet_id'] = $request->wallet_id;
        $cond['address'] = $request->wallet_address;
        $user_wallets_data = UserWallet::where($cond);
        $result = array();
        if($user_wallets_data->count() > 0)
        {
            $user_wallet = $user_wallets_data->first();
            $user_wallet->wallet_name = $request->wallet_name;
            $user_wallet->address = $request->wallet_address;
            $user_wallet->updated_at = date('Y-m-d H:i:s');
            $user_wallet->save();
        } else {
            $data = array();
            $data['user_id'] = $user->id;
            $data['wallet_id'] = $request->wallet_id;
            $data['network_id'] = $request->network_id;
            $data['wallet_name'] = $request->wallet_name;
            $data['address'] = $request->wallet_address;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $user_wallet = UserWallet::create($data);
        }
        $result['status'] = "success";
        $result['wallet'] = $user_wallet;
        return response()->json($result, 200);
    }

    public function getUserNetworkWallets(Request $request, $network_id) 
    {
        $data = array();
        $data['user_wallets'] = array();
        $data['tabs'] = array();
        $cond = array();
        $cond['network_id'] = $network_id;
        $user = Auth::user();
        $cond['user_id'] = $user->id;

        $supported_wallets = SupportedWallet::where('network_id', $network_id)->get();
        foreach($supported_wallets as $s_wallet) {
            $cond['wallet_id'] = $s_wallet->id;
            $user_wallets = UserWallet::where($cond)->get();
            foreach($user_wallets as $u_wallet)
            {
                $u_wallet->key = $s_wallet->supp_wallet_name; 
                $u_wallet->image = $s_wallet->wallet_logo;
            }
            $s_wallet->user_wallets = $user_wallets;
            $wallet = array(
                'id' => $s_wallet->id,
                's_name' => $s_wallet->supp_wallet_name,
                'user_wallets' => $user_wallets
            );
            array_push($data['tabs'], $s_wallet->supp_wallet_name);
            array_push($data['user_wallets'], $wallet);
        }
        // $wallets = UserWallet::where($cond)->get();
        // $data = array();
        // if($wallets->count() > 0){
        //     foreach($wallets as $wallet) {
        //         $wallet->key = $wallet->supportedWallet()->first()->supp_wallet_name; 
        //         $wallet->image = $wallet->supportedWallet()->first()->wallet_logo;
        //     }
        //     $data['user_wallets'] = $wallets;
        // }else{
        //     $data['user_wallets'] = array();
        // }
        return response()->json($data, 200);
    }

    public function getAddedUserWallets(Request $request) {
        $user = Auth::user();
        $cond = array();
        $cond['user_id'] = $user->id;
        $added_wallets= UserWallet::where($cond)->get();
        $data = array();
        if($added_wallets->count() > 0) {
            foreach($added_wallets as $wallet) {
                $wallet->supp_wallet_name = $wallet->supportedWallet()->first()->supp_wallet_name;
            }
        }
        $data['wallets'] = $added_wallets;
        return response()->json($data, 200); 
    }

    public function deleteUserWallet(Request $request, $wallet_id)
    {
        $data = array();
        if(UserWallet::where('id', $wallet_id)->count() > 0) {
            $wallet = UserWallet::findOrFail($wallet_id);
            $wallet->delete();
            $data['result'] = "success";
        }else{
            $data['result'] = "fail";
        }
        return response()->json($data, 200);
    }
}
