<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // if (Auth::user()->role == 'admin') {
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->role == 'admin'){
            return view('layouts.pages.dashboard.dashboard_admin');
        }elseif (Auth::guard('web')->check() && Auth::guard('web')->user()->role == 'user') {
            return view('layouts.pages.dashboard.dashboard_user');
        }else {
            return view('layouts.pages.dashboard.dashboard');
        }
    }
}
