@extends('index')
@section('main_container')
    @vite(['resources/sass/auth/auth.scss',
           'resources/js/auth/auth.js'])
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="header">
                    VENDOR MANAGEMENT
                </div>
            </div>
            <div class="col-md-4 form-auth">
                <div class="card" id="login_form">
                    <div class="card-header-custom">
                        Sign In
                    </div>
                    <br />
                    <span style="color: red; font-weight: 600">{{$errors->first('password')}}</span>    

                    <form method="POST" action="{{route('login.post')}}" onsubmit="submit_disabled(document.getElementById('login_submit'))">
                        @csrf
                        <input type="text" class="form-control" name="email" placeholder="Email">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <button class="btn btn-primary" type="submit" id='login_submit'>Submit</button>
                        <div class="forget-sign-up">
                            <a href="#">Forget Password?</a>
                            <a href="#sign-up" id="btn_sign_up">Sign Up</a>
                        </div>
                    </form>
                </div>

                <div class="card hide hidden" id="register_form">
                    <div class="card-header-custom">
                        Sign Up
                    </div>
                    <br />
                    <form method="POST" action="{{route('register.post')}}" onsubmit="submit_disabled(document.getElementById('submit'))">
                        @csrf
                        <input type="text" class="form-control" name="company_name" placeholder="Enter your company name" value="{{old('company_name')}}">
                        <x-input-error class="error-message" :messages="$errors->get('company_name')" />
                        
                        <select type="text" class="form-control" name="product_community" placeholder="Choose product community">
                            <option value=''>Choose product community</option>
                            <option value="Akomodasi Hotel" @if(old('product_community') == "local") selected @endif>Akomodasi Hotel</option>
                            <option value="Bulk Material" @if(old('product_community') == "Bulk Material") selected @endif>Bulk Material</option>
                            <option value="Cathering" @if(old('product_community') == "Cathering") selected @endif>Cathering</option>
                            <option value="Chemical" @if(old('product_community') == "Chemical") selected @endif>Chemical</option>
                            <option value="Consultant" @if(old('product_community') == "Consultant") selected @endif>Consultant</option>
                        </select>
                        <x-input-error class="error-message" :messages="$errors->get('product_community')" />

                        <input type="text" class="form-control" name="product_range" placeholder="Enter product range" value="{{old('product_range')}}">
                        <x-input-error class="error-message" :messages="$errors->get('product_range')" />

                        <select type="text" class="form-control" name="location" placeholder="Choose location" >
                            <option value=''>Choose location</option>
                            <option value="local" @if(old('location') == "local") selected @endif>Local</option>
                            <option value="foreign" @if(old('location') == "foreign") selected @endif>Foreign</option>
                        </select>
                        <x-input-error class="error-message" :messages="$errors->get('location')" />

                        <input type="text" class="form-control" name="register_email" placeholder="Email" value="{{old('register_email')}}">
                        <x-input-error class="error-message" :messages="$errors->get('register_email')" />
                        
                        <x-text-input type="password" class="form-control" name="register_password" id="register_password" placeholder="Password" onchange="confirm_password(event)" />
                        <x-input-error class="error-message" :messages="$errors->get('register_password')"  />

                        <input type="password" class="form-control" name="register_password_confirmation" id="register_password_confirmation" placeholder="Re-enter password" onchange="confirm_password(event)">
                        <span class="error-message hidden" id="error_message_password">Re-renter password not match</span>
                        <x-input-error class="error-message" :messages="$errors->get('register_password_confirmation')" />

                        <button class="btn btn-primary" type="submit" id="submit" >Submit</button>
                        <div class="forget-sign-in">
                            <a href="#">Forget Password?</a>
                            <a href="#sign-in" id="btn_sign_in">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>

      
    @endsection
