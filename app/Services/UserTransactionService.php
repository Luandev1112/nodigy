<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Validator,Redirect,Response;

use App\Models\User;
use App\Models\UserTransaction;

class UserTransactionService
{
    public function store($data = [])
    {
        if(empty($data)){
            return ['status' => false, 'message' => "no data", 'data' => []];
        }

        DB::beginTransaction();
        try {

            $id = (isset($data['id']) && $data['id'])? $data['id']:"";
            $model = "";

            if($id){
                $model = UserTransaction::where('id',$id)->first();
            }

            if(empty($model))
            {
                $id = "";
                $model = new UserTransaction();
                $model->created_at = now();
            }

            $model->project_id = (isset($data['project_id']) && $data['project_id'])? $data['project_id']:null;
            $model->server_id = (isset($data['server_id']) && $data['server_id'])? $data['server_id']:null;
            $model->user_id = (isset($data['user_id']) && $data['user_id'])? $data['user_id']:null;
            $model->date = (isset($data['date']) && $data['date'])? date('Y-m-d H:i:s', strtotime($data['date'])):now();
            $model->amount = (isset($data['amount']) && $data['amount'])? round($data['amount'],2):0.00;
            $model->txn_id = (isset($data['txn_id']) && $data['txn_id'])? $data['txn_id']:null;
            $model->purpose = (isset($data['purpose']) && $data['purpose'])? $data['purpose']:null;
            $model->status = (isset($data['status']) && $data['status'])? $data['status']:0;
            $model->updated_at = now();
            if(!$model->save()){
                throw new Exception("Error in saving data");
            }

            DB::commit();
            $message = $id ? 'Transaction update successfully' : 'Transaction created successfully';
            return ['status' => true, 'message' => $message, 'data' => $model];

        } catch (Exception $e) {

            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return ['status' => false, 'message' => $message, 'data' => []];

        }
    }

    public function updateBalanceToUser($user_id)
    {
        try {
            $allBalance = UserTransaction::select('amount')
                ->where('user_id', "=", $user_id)
                ->where('amount', ">", 0)
                ->whereIn('status',[1,3])
                ->orderBy('id','ASC')//DESC
                ->get();

            if(!empty($allBalance) && count($allBalance) > 0)
            {
                $total_balance=0;
                foreach ($allBalance as $row){
                    if($row->amount > 0) {
                        $total_balance += $row->amount;
                    }else if($row->amount < 0) {
                        $total_balance -= $row->amount;
                    }
                }

                $model = User::where('id',$user_id)->first();
                if(isset($model->id)){
                    $model->balance = round($total_balance,2);
                    if(!$model->save()){
                        Log::info("user_id: ".$user_id." error in update balance to user!");
                    }
                }
            }
        } catch (Exception $e) {
            Log::info($e);
        }
        return true;
    }
}
