<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class QhseController extends Controller
{
    function index(){
        $session = DB::Connection('SURVEY')->table('SESSION')->where('SESSION_USER_ID',Auth::user()->MEMBER_UUID)->where('SESSION_SURVEY_UUID','B82A8B0D-05B2-49EE-9222-C51634E1BC9C')->get();


        return view('qhse.qhse', compact('session'));
    }

    function view(Request $request){
        $CryptController = new CryptController;
        $crypt_email = $CryptController->cryptString(Auth::user()->MEMBER_EMAIL);
        $crypt_last_login = $CryptController->cryptString(Auth::user()->MEMBER_LAST_LOGIN);
        
        $SESSION_UUID = $request->SESSION_UUID;
        $SESSION = DB::Connection('SURVEY')->table('SESSION')->join('SURVEY','SURVEY_UUID','=','SESSION_SURVEY_UUID')->where('SESSION_UUID',$request->SESSION_UUID)->first();

        return view('qhse.qhse-detail', compact('SESSION_UUID','SESSION','crypt_email','crypt_last_login'));
    }

    function store(){
        $CryptController = new CryptController;
        $crypt_email = $CryptController->cryptString(Auth::user()->MEMBER_EMAIL);
        $crypt_last_login = $CryptController->cryptString(Auth::user()->MEMBER_LAST_LOGIN);
        $survey_slug = DB::Connection('SURVEY')->table('SURVEY')->select('SURVEY_SLUG')->where('SURVEY_UUID','B82A8B0D-05B2-49EE-9222-C51634E1BC9C')->first();
        return view('qhse.qhse-store', compact('crypt_email','crypt_last_login','survey_slug'));
    }
}
