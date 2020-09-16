<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('dashboard.dashboard', ['user' => Auth::user()]);
    }
}
