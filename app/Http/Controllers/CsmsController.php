<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsmsController extends Controller
{
    function index(){
        return view('csms.csms');
    }
}
