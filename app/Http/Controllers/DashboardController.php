<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class DashboardController extends Controller
{
    function index(){
        return view('dashboard.dashboard');
    }
}
