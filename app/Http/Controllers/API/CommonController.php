<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\UserWallet;

class CommonController extends BaseController
{
    public function verifyWalletAddress(Request $request) {

        $validator = Validator::make($request->all(), [
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation failed', $validator->errors(),422);
        }

        $address = $request->input('address');

        $pattern = '/^n1[0-9a-zA-Z]{38}$/';

        if (preg_match($pattern, $address)) {
            $success = [
                'is_valid' => true,
            ];
            return $this->sendResponse($success, 'Address format is valid.');
        } else {
            $success = [
                'is_valid' => false,
            ];
            return $this->sendResponse($success, 'Address format is invalid.');
        }
    }
}
