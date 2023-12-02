<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        if(auth()->user())
        {
            return redirect('/admin');
        }
        else
        {
            return view('admin/login/index');
        }
       
    }
}
