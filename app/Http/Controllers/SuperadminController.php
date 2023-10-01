<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function showChangePasswordPage(){
        return view('superadmin.change-password');
    }
}
