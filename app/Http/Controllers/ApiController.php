<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Carbon\Carbon;

use Auth;

class ApiController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function userdetail()
    {        
        $loginUser = Auth::user();

        $response = [
            'success' => true,
            'data'    => $loginUser,
            'message' => '',
        ];


        return response()->json($response, 200);
    }    
}
