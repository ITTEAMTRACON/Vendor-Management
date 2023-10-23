<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CryptController;
use App\Models\User;
use App\Models\VENDOR;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use DB;

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

        $MEMBER = User::where('MEMBER_EMAIL',$request->register_email)
                        ->where(function ($query)  {
                            $query->where('MEMBER_STATUS','!=',0)
                                ->orWhere('MEMBER_STATUS', NULL);
                        })
                        ->get();
        if(!$MEMBER->isEmpty()){
            return redirect("/login#sign-up")->with('error','Email is already in use')->withInput();
        }

        $MEMBERCHECK = User::where('MEMBER_COMPANY_NAME',$request->company_name)->where('MEMBER_STATUS',1)->get();
        if(count($MEMBERCHECK)>0){
            return redirect("/login#sign-up")->with('error','Company name is already in use')->withInput();
        }
        DB::connection('VENDORMANAGEMENT')->transaction(function() use ($request) {
            $member = User::create([
                // 'MEMBER_COMPANY_NAME' => $request->company_name,
                // 'MEMBER_PRODUCT_COMMUNITY' => $request->product_community,
                // 'MEMBER_PRODUCT_RANGE' => $request->product_range,
                // 'MEMBER_LOCATION' => $request->location,
                'MEMBER_EMAIL' => $request->register_email,
                'MEMBER_PASSWORD' => bcrypt($request->register_password),
                'MEMBER_LAST_LOGIN' =>  date('Y-m-d H:i:s'),
            ]);

            $member = User::where('MEMBER_ID',$member->MEMBER_ID)->first();
           
            $vendor = VENDOR::create([
                'VM_CODE' => $this->generateVendorCode($request->location),
                'VM_NAME' => $request->company_name,
                'VM_COMMUNITY' => $request->product_community,
                'VM_PRODUCTRANGE' => $request->product_range,
                'VM_LOCATION' => $request->location,
                'VM_MEMBER_UUID' => $member->MEMBER_UUID,
                'VM_EMAIL' => $request->register_email,
                'CREATED_BY_ID' => $member->MEMBER_UUID,
                'CREATED_BY_NAME' => $request->company_name,
                'CREATED_DATE' =>  date('Y-m-d H:i:s'),
                
            ]);

            event(new Registered($member));

            // Auth::login($member);
        });
        return redirect("/login#sign-up")->with('success','Thanks for your register. Please wait until email is confirmed by our admin. We will notify you via email!');
        // return redirect(RouteServiceProvider::HOME);
    }

    public function generateVendorCode($location){
        if($location == "Local"){
            $vendor =   VENDOR::where('VM_LOCATION','Local')->where('VM_CODE','like','DN-%')->orderBy('CREATED_DATE','DESC')->get();
            if($vendor->count() < 1){
                $code = 'DN-'.sprintf('%04d', 1);
            }
            else{
                $lastCode   = $vendor->first()->VM_CODE;
                $number     = substr($lastCode,3,4);
                $code       = 'DN-'.sprintf('%04d', intval((int) $number) + 1);
            }
        }
        elseif($location == "Foreign"){
            $vendor =   VENDOR::where('VM_LOCATION','Foreign')->where('VM_CODE','like','LN-%')->orderBy('VM_CODE','DESC')->get();
            if($vendor->count() < 1){
                $code = 'LN-'.sprintf('%03d', 1);
            }
            else{
                $lastCode   = $vendor->first()->VM_CODE;
                $number     = substr($lastCode,3,3);
                $code       = 'LN-'.sprintf('%03d', intval($number) + 1);
            }
        }
        return $code;
    }

    public function register_link(Request $request)
    {
        $token = $request->token;
        $vendor = VENDOR::where('VM_LINK_TOKEN',$request->token)->first();
        if(empty($vendor)){
            return "Link incorrect";
        }
        $expired_date = strtotime($vendor->VM_LINK_TOKEN_CREATE_AT);
        $expired_date = strtotime("+1 day", $expired_date);
        $expired_date = date('Y-m-d H:i:s', $expired_date);
        if($expired_date < date('Y-m-d H:i:s')){
            echo 'expired link';
            // return view('auth.register-link', compact('expired_date','token'));

        }else{
            return view('auth.register-link', compact('expired_date','token'));
        }

       
    }

    public function register_link_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'register_email' => ['required', 'string', 'email', 'max:255'],
            'register_password' => ['required','required_with:register_password_confirmation','same:register_password_confirmation'],
            'register_password_confirmation' => ['required'],
        ]);

        if ($validator->fails()) {
            return  back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::connection('VENDORMANAGEMENT')->transaction(function() use ($request) {
            $token = $request->token;
            $CryptController = new CryptController;
            $decrypt_token = $CryptController->decryptString($token);
            $decrypt_token = explode("/",$decrypt_token);
            $vendor = VENDOR::where('VM_ID',$decrypt_token[0])->first();
            
            $memberCheck = User::where('MEMBER_UUID', $vendor->VM_MEMBER_UUID)->where('MEMBER_STATUS',1)->first();
            if( !empty($memberCheck) ){
                return 'Error! This link already have account';
            }

            $expired_date = strtotime($decrypt_token[1]);
            $expired_date = strtotime("+1 day", $expired_date);
            $expired_date = date('Y-m-d H:i:s', $expired_date);
            if($decrypt_token[1] >= $expired_date){
                echo 'expired link';
            }else{
                $member = new User;
                $member->MEMBER_EMAIL = $request->register_email;
                $member->MEMBER_PASSWORD = bcrypt($request->register_password);
                $member->MEMBER_LAST_LOGIN =  date('Y-m-d H:i:s');
                $member->save();

                $member_uuid = User::select('MEMBER_UUID')->where('MEMBER_ID',$member->MEMBER_ID)->first();
                $vendor->VM_MEMBER_UUID = $member_uuid->MEMBER_UUID;
                $vendor->VM_LINK_TOKEN = NULL;
                $vendor->save();
            }
        });
        return redirect("/login#sign-up")->with('success','Thanks for your register. Please wait until email is confirmed by our admin. We will notify you via email!');
    }

}
