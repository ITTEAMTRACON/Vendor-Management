<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Auth\CryptRequest;
use Auth;
use DB;
use App\Http\Controllers\CryptController;


class PrequalificationController extends Controller
{
    function index(){

        $session = DB::Connection('SURVEY')->table('SESSION')->where('SESSION_USER_ID',Auth::user()->MEMBER_UUID)->where('SESSION_SURVEY_UUID','642EC694-ABA9-4B99-BCF1-8E695C1386DB')->get();


        return view('prequalification.prequalification', compact('session'));
    }

    function view(Request $request){
        $CryptController = new CryptController;
        $crypt_email = $CryptController->cryptString(Auth::user()->MEMBER_EMAIL);
        $crypt_last_login = $CryptController->cryptString(Auth::user()->MEMBER_LAST_LOGIN);
        
        $SESSION_UUID = $request->SESSION_UUID;
        $SESSION = DB::Connection('SURVEY')->table('SESSION')->join('SURVEY','SURVEY_UUID','=','SESSION_SURVEY_UUID')->where('SESSION_UUID',$request->SESSION_UUID)->first();

        return view('prequalification.prequalification-detail', compact('SESSION_UUID','SESSION','crypt_email','crypt_last_login'));
    }

    function store(){
        $CryptController = new CryptController;
        $crypt_email = $CryptController->cryptString(Auth::user()->MEMBER_EMAIL);
        $crypt_last_login = $CryptController->cryptString(Auth::user()->MEMBER_LAST_LOGIN);

        return view('prequalification.prequalification-store', compact('crypt_email','crypt_last_login'));
    }
}
