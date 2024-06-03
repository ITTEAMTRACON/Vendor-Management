<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\SESSION;

class QhseController extends Controller
{
    function index(){
        $session = SESSION::where('SESSION_USER_ID',Auth::user()->MEMBER_UUID)->where('SESSION_SURVEY_UUID','8B6D8C19-BC3C-4DBF-83B5-88CE89C8D892')->get();


        return view('qhse.qhse', compact('session'));
    }

    function view(Request $request){
        $CryptController = new CryptController;
        $crypt_email = $CryptController->cryptString(Auth::user()->MEMBER_EMAIL);
        $crypt_last_login = $CryptController->cryptString(Auth::user()->MEMBER_LAST_LOGIN);
        
        $SESSION_UUID = $request->SESSION_UUID;
        $SESSION = DB::Connection('SURVEY')->table('SESSION')->join('SURVEY','SURVEY_UUID','=','SESSION_SURVEY_UUID')->where('SESSION_UUID',$request->SESSION_UUID)->first();
        $approval_history = DB::connection('VENDORMANAGEMENT')->table('APPROVAL')->where('APR_RELATION_ID',$request->SESSION_UUID)->orderby('APR_ORDER','asc')->get();

        return view('qhse.qhse-detail', compact('SESSION_UUID','SESSION','crypt_email','crypt_last_login','approval_history'));
    }

    function store(){
        $CryptController = new CryptController;
        $crypt_email = $CryptController->cryptString(Auth::user()->MEMBER_EMAIL);
        $crypt_last_login = $CryptController->cryptString(Auth::user()->MEMBER_LAST_LOGIN);
        $survey_slug = DB::Connection('SURVEY')->table('SURVEY')->select('SURVEY_SLUG')->where('SURVEY_UUID','8B6D8C19-BC3C-4DBF-83B5-88CE89C8D892')->first();
        return view('qhse.qhse-store', compact('crypt_email','crypt_last_login','survey_slug'));
    }

     function certificateIndex(){
        $session = SESSION::where('SESSION_USER_ID',Auth::user()->MEMBER_UUID)->where('SESSION_SURVEY_UUID','F45F722F-1179-4D6A-8007-90D5A3A58333')->get();


        return view('qhse.certificate-index', compact('session'));
    }

    function certificateView(Request $request){
        $CryptController = new CryptController;
        $crypt_email = $CryptController->cryptString(Auth::user()->MEMBER_EMAIL);
        $crypt_last_login = $CryptController->cryptString(Auth::user()->MEMBER_LAST_LOGIN);
        
        $SESSION_UUID = $request->SESSION_UUID;
        $SESSION = DB::Connection('SURVEY')->table('SESSION')->join('SURVEY','SURVEY_UUID','=','SESSION_SURVEY_UUID')->where('SESSION_UUID',$request->SESSION_UUID)->first();
        $approval_history = DB::connection('VENDORMANAGEMENT')->table('APPROVAL')->where('APR_RELATION_ID',$request->SESSION_UUID)->orderby('APR_ORDER','asc')->get();

        return view('qhse.qhse-detail', compact('SESSION_UUID','SESSION','crypt_email','crypt_last_login','approval_history'));
    }

    function certificateStore(){
        $CryptController = new CryptController;
        $crypt_email = $CryptController->cryptString(Auth::user()->MEMBER_EMAIL);
        $crypt_last_login = $CryptController->cryptString(Auth::user()->MEMBER_LAST_LOGIN);
        $survey_slug = DB::Connection('SURVEY')->table('SURVEY')->select('SURVEY_SLUG')->where('SURVEY_UUID','F45F722F-1179-4D6A-8007-90D5A3A58333')->first();
        return view('qhse.certificate-store', compact('crypt_email','crypt_last_login','survey_slug'));
    }

}
