<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Carbon\Carbon;

use Auth;

class DashboardController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {        
        $loginUser = Auth::user();

        return view('dashboard.index',compact(
            'loginUser',
        ));
    }    

    public function getUser(Request $request)
    {
        $loginUser = Auth::user();
        return response()->json($loginUser, 200);
    }
}
