<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function Register(Request $request)
    {
    	$all = $request->all();
    	dd(all);
    }
}
