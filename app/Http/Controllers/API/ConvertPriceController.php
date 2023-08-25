<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

use App\Services\HetznerApiService;

use App\Models\User;

class ConvertPriceController extends BaseController
{
    public $service;

    public function __construct()
    {
        $this->service = new HetznerApiService;
    }
    public function getEuroToUSDT(Request $request)
    {
        $rules=[
            'euro_price'=>"required",
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

                $euroPrice = $request->euro_price;
                $usdtPrice = $this->service->geBinancePrice();

                $result = [];
                $result['amountInUSDT'] = convertEuroToUSDT($euroPrice,$usdtPrice);
                $result['amountInEUR'] = sprintf("%.2f",$euroPrice);

                return $this->sendResponse($result, 'Convert Price Successfully.');
            } catch (Exception $e) {
                $message = $e->getMessage() . $e->getLine();
                Log::info("viewServer:".$message);
                return $this->sendError('Error', ['error'=>'Error get Price data. Please try again'],201);
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong. Please try again'],404);
    }

    public function getEuroExchangeRate(Request $request)
    {
        $exchangeRate = $this->service->geBinancePrice();
        $result = array();
        $result['rate'] = $exchangeRate;
        return $this->sendResponse($result, 'Convert Price Successfully.');
        
    }
}