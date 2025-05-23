<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Auth;
use Mail;
use App\Jobs\SendEmailForgetPassword;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        if (Hash::check($request->current_password, Auth::user()->MEMBER_PASSWORD)) {
            
            $request->user()->update([
                'MEMBER_PASSWORD' => Hash::make($validated['password']),
            ]);

            return back()->with('success', 'Save Successful');
        }else{
            return back()->with('error', 'Password not match');
        }

    }

    public function view_change_pasword()
    {
        return view('auth.change-password');
    }

    public function forget_password(Request $request){

        $user = User::where('MEMBER_EMAIL',$request->email_forget_password)
                      ->where('MEMBER_STATUS',1)
                      ->first();

		if(!$user){
			$errors['email']='The email that you input is not registered. Please type another email or try to sign up.';
			return redirect()->back()->withInput()->withErrors($errors);
		}
		else{
			$user->MEMBER_RESET_CODE = Str::random(50);
			$user->save();

			// send email
		    dispatch(new SendEmailForgetPassword($request->email_forget_password, $user->MEMBER_COMPANY_NAME,  $user->MEMBER_RESET_CODE ));


			// \LogActivity::addToLog( request()->ip(),'Forgot Password','success');
			return redirect()->back()->withInput()->with('success', 'Success !! Please check your E-mail to update your password.');
		}
			

    }

    public function reset_password_view(Request $request){
        $token = $request->token;
        $user = USER::where('MEMBER_RESET_CODE',$request->token)->first();
        if(!$user){
            return redirect("/login#sign-in")->withInput()->with('error', 'Error !! Token expired ');
        }

        return view('auth.reset-password', compact('token'));
    }

    public function reset_password_store(Request $request){
        // dd(Request()->All());
        $validator = Validator::make($request->all(), [
            'password' => ['required','required_with:password_confirmation','same:password_confirmation','min:6'],
            'password_confirmation' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = USER::where('MEMBER_RESET_CODE',$request->token)->update(['MEMBER_PASSWORD'=>bcrypt($request->password), 
                                                                          'MEMBER_RESET_CODE'=>NULL,
                                                                          'MEMBER_UPDATED_AT'=>date('Y-m-d H:i:s')]);

        return redirect("/login#sign-in")->withInput()->with('success', 'Success !! Reset password is successfully');
    }


}
