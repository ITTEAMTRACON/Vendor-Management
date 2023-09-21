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



class LoginUserController extends Controller
{
  
    public function post_login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:6'],
        ]);

        $user = User::where("MEMBER_EMAIL",$request->email)->first();

        if ($user && Hash::check($request->password, $user->MEMBER_PASSWORD)  ) {
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        }else{
            throw ValidationException::withMessages([
                'password' => 'Incorrect email or password',
            ]);
            return back();
        }
    }

    public function send_auth(){
        $auth = Auth::user();
        return $auth;
    }
}
    