<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Auth;

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

            return back()->with('success', 'Save');
        }else{
            return back()->with('error', 'Password not match');
        }

    }

    public function view_change_pasword()
    {
        return view('auth.change-password');
    }
}
