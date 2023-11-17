@extends('index')
@section('main_container')
    @vite(['resources/sass/auth/auth.scss', 'resources/js/auth/auth.js'])
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="header">
                    <img src="images/VENOM-SSO-new.png" />  
                </div>
            </div>
            <div class="col-md-4 form-auth">
                <div class="card" id="login_form">
                    <div class="card-header-custom">
                        Sign In
                    </div>
                    <br />
                    @if (session('error'))
                        <x-notification.badge-message class="mt-2" messages="{{ session('error') }}" type="danger"
                            textAlign="center" />
                    @endif

                    <span style="color: red; font-weight: 600">{{ $errors->first('password') }}</span>

                    <form method="POST" action="{{ route('login.post') }}"
                        onsubmit="submit_disabled(document.getElementById('login_submit'))">
                        @csrf
                        <input type="text" class="form-control" name="email" placeholder="Email">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <button class="btn btn-primary" type="submit" id='login_submit'>Submit</button>
                        <div class="forget-sign-up">
                            <a href="#forget-password" id="btn_forget_password">Forget Password?</a>
                            <a href="#sign-up" id="btn_sign_up">Sign Up</a>
                        </div>
                    </form>
                </div>

                <div class="card hide hidden" id="register_form">
                    <div class="card-header-custom">
                        Sign Up
                    </div>
                    <br />
                    @if (session('error'))
                        <x-notification.badge-message class="mt-2" messages="{{ session('error') }}" type="danger" />
                    @elseif(session('success'))
                        <x-notification.badge-message class="mt-2" messages="{{ session('success') }}" type="success"
                            style="text-align: center" textAlign="center" />
                    @endif
                    {{-- <x-notification.badge-message class="mt-2" messages="Thanks for your register. Please wait until email is confirmed by our admin. We will notify you via email!" type="success"  textAlign="center" /> --}}


                    <form method="POST" action="{{ route('register.post') }}"
                        onsubmit="submit_disabled(document.getElementById('submit'))">
                        @csrf
                        <input type="text" class="form-control" name="company_name" placeholder="Enter your company name"
                            value="{{ old('company_name') }}" autocomplete="off" >
                        <x-input-error class="error-message" :messages="$errors->get('company_name')" />
                            
                        <select type="text" class="form-control" name="product_community"
                            placeholder="Choose product community">
                            <option value=''>Choose product community</option>
                            {{-- <option value="Akomodasi Hotel" @if (old('product_community') == 'Akomodasi Hotel') selected @endif>Akomodasi
                                Hotel</option>
                            <option value="Bulk Material" @if (old('product_community') == 'Bulk Material') selected @endif>Bulk Material
                            </option>
                            <option value="Cathering" @if (old('product_community') == 'Cathering') selected @endif>Cathering</option>
                            <option value="Chemical" @if (old('product_community') == 'Chemical') selected @endif>Chemical</option>
                            <option value="Consultant" @if (old('product_community') == 'Consultant') selected @endif>Consultant</option> --}}
                            @foreach ($PRODUCTCOMMUNITY as $item)
                                <option value="{{$item->PC_ID}}" @if(old('product_community') == $item->PC_ID) selected @endif>{{$item->PC_NAME}}</option>
                            @endforeach
                        </select>
                        <x-input-error class="error-message" :messages="$errors->get('product_community')" />

                        <input type="text" class="form-control" name="product_range" placeholder="Enter product range"
                            value="{{ old('product_range') }}" autocomplete="off" >
                        <x-input-error class="error-message" :messages="$errors->get('product_range')" />

                        <select type="text" class="form-control" name="location" placeholder="Choose location">
                            <option value=''>Choose location</option>
                            <option value="Local" @if (old('location') == 'Local') selected @endif>Local</option>
                            <option value="Foreign" @if (old('location') == 'Foreign') selected @endif>Foreign</option>
                        </select>
                        <x-input-error class="error-message" :messages="$errors->get('location')" />

                        <input type="text" class="form-control" name="register_email" placeholder="Email"
                            value="{{ old('register_email') }}">
                        <x-input-error class="error-message" :messages="$errors->get('register_email')" />

                        <x-text-input type="password" class="form-control" name="register_password" id="register_password"
                            placeholder="Password" onchange="confirm_password(event)" />
                        <x-input-error class="error-message" :messages="$errors->get('register_password')" />

                        <input type="password" class="form-control" name="register_password_confirmation"
                            id="register_password_confirmation" placeholder="Re-enter password"
                            onchange="confirm_password(event)">
                        <span class="error-message hidden" id="error_message_password">Re-renter password not match</span>
                        <x-input-error class="error-message" :messages="$errors->get('register_password_confirmation')" />

                        <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                        <div class="forget-sign-in">
                            <a href="#forget-password" id="btn_forget_password_2">Forget Password?</a>
                            <a href="#sign-in" id="btn_sign_in">Sign In</a>
                        </div>
                    </form>
                </div>

                <div class="card hide hidden" id="forget_password_form">
                    <div class="card-header-custom">
                        Forget Password
                    </div>
                    <br />
                    @if (session('error'))
                        <x-notification.badge-message class="mt-2" messages="{{ session('error') }}" type="danger" />
                    @elseif(session('success'))
                        <x-notification.badge-message class="mt-2" messages="{{ session('success') }}" type="success"
                            style="text-align: center" textAlign="center" />
                    @endif
                    {{-- <x-notification.badge-message class="mt-2" messages="Thanks for your register. Please wait until email is confirmed by our admin. We will notify you via email!" type="success"  textAlign="center" /> --}}


                    <form method="POST" action="{{ route('forget-password.post') }}"
                        onsubmit="submit_disabled(document.getElementById('submit'))">
                        @csrf
                        

                        <input type="text" class="form-control" name="email_forget_password" placeholder="Email"
                            value="{{ old('email_forget_password') }}">
                        <x-input-error class="error-message" :messages="$errors->get('email_forget_password')" />

                        

                        <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                        <div class="forget-sign-in">
                            <a href="#sign-in" id="btn_sign_in_2">Sign In</a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    @endsection
