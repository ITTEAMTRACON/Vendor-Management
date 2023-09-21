<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'company_name' => ['required', 'string', 'max:255'],
            'product_community' => ['required', 'string', 'max:50'],
            'product_range' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'register_email' => ['required', 'string', 'email', 'max:255'],
            'register_password' => ['required','required_with:register_password_confirmation','same:register_password_confirmation'],
            'register_password_confirmation' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect('/login#sign-up')
                        ->withErrors($validator)
                        ->withInput();
        }

        $member = Member::create([
            'MEMBER_COMPANY_NAME' => $request->company_name,
            'MEMBER_PRODUCT_COMMUNITY' => $request->product_community,
            'MEMBER_PRODUCT_RANGE' => $request->product_range,
            'MEMBER_LOCATION' => $request->location,
            'MEMBER_EMAIL' => $request->register_email,
            'MEMBER_PASSWORD' => bcrypt($request->register_password),
        ]);

        event(new Registered($member));

        Auth::login($member);

        return redirect(RouteServiceProvider::HOME);
    }
}
