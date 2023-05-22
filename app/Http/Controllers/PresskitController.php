<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresskitController extends Controller
{    
    public function index()
    {        
        return view('presskit.index');
    }    
}
