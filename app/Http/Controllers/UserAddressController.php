<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function index(){
        return view('user.addresses', ['user' => Auth::user()]);
    }
}