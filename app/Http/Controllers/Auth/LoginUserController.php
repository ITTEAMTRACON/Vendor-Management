<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Auth as Authentification;



class LoginUserController extends Controller
{
  
    public function post_login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:6'],
        ]);
        $user = User::leftjoin('VENDORMANAGEMENT.dbo.VENDOR as VENDOR','VENDOR.VM_MEMBER_UUID','=','MEMBER_UUID')->where("MEMBER_EMAIL",$request->email)->where("MEMBER_STATUS",1)->first();
        // dd($request->email, $user);
        if(empty($user)){
            $user = User::where("MEMBER_EMAIL",$request->email)->where("MEMBER_STATUS",NULL)->first();
            if(!empty($user)){
                return back()->with('error','Your account has not been confirmed by our admin. Please wait !');
            }

            $user = User::where("MEMBER_EMAIL",$request->email)->where("MEMBER_STATUS",0)->first();
            if(!empty($user)){
                return back()->with('error','Sorry! Your account was rejected');
            }
        }

        if ($user && Hash::check($request->password, $user->MEMBER_PASSWORD)  ) {
            Auth::login($user);
            $user->MEMBER_LAST_LOGIN =  date('Y-m-d H:i:s');
            $user->save();
            return redirect("pre-qualification");
        }else{
            throw ValidationException::withMessages([
                'password' => 'Incorrect email or password',
            ]);
            return back();
        }
    }

    public function send_auth(){
        $auth = Authentification::user();
        return $auth;
    }
}
    