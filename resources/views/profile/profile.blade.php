@extends('index')
@section('title', 'Profile')
@section('main_container')
    @include('components.header')
    @include('components.sidebar')
    @vite(['resources/sass/profile/profile.scss', 'resources/js/profile/profile.js'])



    <div class="container-style">
        <header>
            Profile
        </header>


        @if (session('status') == 'profile-updated')
            <x-notification.badge-message class="mt-2" messages="General information updated successful" type="success"
                animation="animationTemporaryShow" /><br>
        @elseif(count($errors) > 0)
            <x-notification.badge-message class="mt-2" messages="Updated failed" type="danger" /><br>
        @elseif(session('status') == 'contact-person-updated')
            <x-notification.badge-message class="mt-2" messages="Contact person updated successful" type="success"
                animation="animationTemporaryShow" /><br>
        @endif

        <div class="card profile">
            <div class="nav-menu">
                <div class="col-md-6 nav-item active" id="general_information">
                    General Information
                </div>
                <div class="col-md-6 nav-item" id="contact_person">
                    Contact Person
                </div>
            </div>

            <br><br>


            {{-- {{$errors}} --}}

            <form id="form_general_information" class="collapse show" method="post" action="{{ route('profile.update') }}"
                onsubmit="submit_disabled(document.getElementById('btn_save_general_information'))">
                @csrf
                @method('patch')
                <div class="col-md-12" style="display: flex">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="vendor_name" class="col-sm-4 col-form-label">Vendor Name*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="vendor_name" name="vendor_name"
                                    value="{{ old('vendor_name', Auth()->user()->vendor->VM_NAME) }}" disabled autocomplete="off">
                                <x-input-error class="mt-2" :messages="$errors->get('vendor_name')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_community" class="col-sm-4 col-form-label">Product Community*</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-control" name="product_community"
                                    placeholder="Choose product community" disabled>
                                    @foreach ($product_community as $row)
                                        <option value="{{ $row->PC_ID }}"
                                            @if (old('product_community', Auth()->user()->vendor->VM_COMMUNITY) == $row->PC_ID) selected @endif>
                                            {{ $row->PC_NAME }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('product_community')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_range" class="col-sm-4 col-form-label">Product Range*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="product_range" name="product_range"
                                    value="{{ old('product_range', Auth()->user()->vendor->VM_PRODUCTRANGE) }}" disabled autocomplete="off">
                                <x-input-error class="mt-2" :messages="$errors->get('product_range')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-sm-4 col-form-label">Location*</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-control" name="location" placeholder="Choose location"
                                    disabled>
                                    <option value=''>Choose location</option>
                                    <option value="Local" @if (old('location', Auth()->user()->vendor->VM_LOCATION) == 'Local') selected @endif>Local</option>
                                    <option value="Foreign" @if (old('location', Auth()->user()->vendor->VM_LOCATION) == 'Foreign') selected @endif>Foreign
                                    </option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('location')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label">Address (as on Tax Invoice)</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" id="address" name="address" disabled autocomplete="off">{{ old('address', Auth()->user()->vendor->VM_ADDRESS) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-sm-4 col-form-label">Country*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="country" name="country"
                                    value="{{ old('country', Auth()->user()->vendor->VM_COUNTRY) }}" disabled autocomplete="off">
                                <x-input-error class="mt-2" :messages="$errors->get('country')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-sm-4 col-form-label">City*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{ old('city', Auth()->user()->vendor->VM_CITY) }}" disabled autocomplete="off">
                                <x-input-error class="mt-2" :messages="$errors->get('city')" />

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label">Phone*</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', Auth()->user()->vendor->VM_PHONE) }}" disabled autocomplete="off">
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facsimile" class="col-sm-4 col-form-label">Facsimile</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="facsimile" name="facsimile"
                                    value="{{ old('facsimile', Auth()->user()->vendor->VM_FACSIMILE) }}" disabled autocomplete="off">
                                <x-input-error class="mt-2" :messages="$errors->get('facsimile')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', Auth()->user()->MEMBER_EMAIL) }}" disabled>
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-sm-4 col-form-label">Website</label>
                            <div class="col-sm-8">
                                <input type="url" class="form-control" id="website" name="website"
                                    placeholder="https://example.com"
                                    value="{{ old('website', Auth()->user()->vendor->VM_WEBSITE) }}" disabled autocomplete="off">
                                <x-input-error class="mt-2" :messages="$errors->get('website')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postal_code" class="col-sm-4 col-form-label">Postal Code*</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="postal_code" name="postal_code"
                                    value="{{ old('postal_code', Auth()->user()->vendor->VM_POSTAL_CODE) }}" disabled autocomplete="off">
                                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="col-md-12">
                    <div class="text-right">
                        <a class="btn btn-info collapse" id="btn_cancel_general_information">Cancel</a>
                        <button class="btn btn-success collapse" id="btn_save_general_information">Save</button>
                        <a class="btn btn-warning collapse show" id="btn_edit_general_information">Edit</a>
                    </div>
                </div>

            </form>


            <form id="form_contact_person" class="collapse" method="post"
                action="{{ route('profile.update-contact-person') }}"
                onsubmit="submit_disabled(document.getElementById('btn_save_contact_person'))">
                @csrf
                @method('patch')
                <div class="col-md-12" style="display: flex">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="cp_name" class="col-sm-4 col-form-label">Name*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="cp_name" name="cp_name"
                                    value="{{ old('cp_name', $contact_person?->CP_NAME) }}" disabled>
                                <x-input-error class="mt-2" :messages="$errors->get('cp_name')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cp_position" class="col-sm-4 col-form-label">Position*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="cp_position" name="cp_position"
                                    value="{{ old('cp_position', $contact_person?->CP_POSITION) }}" disabled>
                                <x-input-error class="mt-2" :messages="$errors->get('cp_position')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cp_email" class="col-sm-4 col-form-label">Email*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="cp_email" name="cp_email"
                                    value="{{ old('cp_email', $contact_person?->CP_EMAIL) }}" disabled>
                                <x-input-error class="mt-2" :messages="$errors->get('cp_email')" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="cp_phone" class="col-sm-4 col-form-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="cp_phone" name="cp_phone"
                                    value="{{ old('cp_phone', $contact_person?->CP_PHONE1) }}" disabled>
                                <x-input-error class="mt-2" :messages="$errors->get('cp_phone')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cp_mobile_phone" class="col-sm-4 col-form-label">Mobile Phone*</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="cp_mobile_phone" name="cp_mobile_phone"
                                    value="{{ old('cp_mobile_phone', $contact_person?->CP_PHONE2) }}" disabled>
                                <x-input-error class="mt-2" :messages="$errors->get('cp_mobile_phone')" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cp_facsimile" class="col-sm-4 col-form-label">Facsimile</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="cp_facsimile" name="cp_facsimile"
                                    value="{{ old('cp_facsimile', $contact_person?->CP_FAX) }}" disabled>
                                <x-input-error class="mt-2" :messages="$errors->get('cp_facsimile')" />
                            </div>
                        </div>
                    </div>

                </div>

                <br>
                <div class="col-md-12">
                    <div class="text-right">
                        <a class="btn btn-info collapse" id="btn_cancel_contact_person">Cancel</a>
                        <button class="btn btn-success collapse" id="btn_save_contact_person">Save</button>
                        <a class="btn btn-warning collapse show" id="btn_edit_contact_person">Edit</a>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if( {{session('contact-person')}}){
                document.getElementById('contact_person').click()
            }
        }, false);
    </script>
@endsection
