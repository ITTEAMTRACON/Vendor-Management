<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Http\Requests\Profile\ProfileUpdateContactPersonRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\CONTACTPERSON;
use App\Models\VENDOR;
use App\Models\PRODUCTCOMMUNITY;

class ProfileController extends Controller
{

    public function index(): View
    {   
        $contact_person = CONTACTPERSON::where('CP_VM_ID',Auth::user()->MEMBER_UUID)->first();
        $product_community = PRODUCTCOMMUNITY::get();

        return view('profile.profile',[
            'user' => 'user',
            'contact_person' => $contact_person,
            'product_community' => $product_community
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();
        $VENDOR = VENDOR::where("VM_MEMBER_UUID", Auth::user()->MEMBER_UUID )->first();
        $VENDOR->VM_NAME = $request->vendor_name;
        $VENDOR->VM_COMMUNITY = $request->product_community;
        $VENDOR->VM_PRODUCTRANGE = $request->product_range;
        $VENDOR->VM_ADDRESS = $request->address;
        $VENDOR->VM_LOCATION = $request->location;
        $VENDOR->VM_COUNTRY = $request->country;
        $VENDOR->VM_CITY = $request->city;
        $VENDOR->VM_PHONE = $request->phone;
        $VENDOR->VM_FACSIMILE = $request->facsimile;
        $VENDOR->VM_WEBSITE = $request->website;
        $VENDOR->VM_POSTAL_CODE = $request->postal_code;
        $VENDOR->save();

        return redirect()->back()->withInput()->with('status', 'profile-updated');
    }

    public function update_contact_person(ProfileUpdateContactPersonRequest $request): RedirectResponse
    {
        $contact_person = CONTACTPERSON::where('CP_VM_ID',Auth::user()->MEMBER_UUID)->first();
        if(is_null($contact_person)){
            $contact_person = new CONTACTPERSON;
        }
        $contact_person->CP_VM_ID = Auth::user()->MEMBER_UUID;
        $contact_person->CP_NAME = $request->cp_name;
        $contact_person->CP_POSITION = $request->cp_position;
        $contact_person->CP_EMAIL = $request->cp_email;
        $contact_person->CP_PHONE1 = $request->cp_phone;
        $contact_person->CP_PHONE2 = $request->cp_mobile_phone;
        $contact_person->CP_FAX = $request->cp_facsimile;
        $contact_person->save();
    

        return redirect()->back()->withInput()->with('status', 'contact-person-updated');
    }





    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
