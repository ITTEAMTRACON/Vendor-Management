<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrequalificationController extends Controller
{
    function index(){
        return view('prequalification.prequalification');
    }

    function view(){
        return view('prequalification.prequalification-detail');
    }
}
