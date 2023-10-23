@extends('index')
@section('script_link')
    @vite(['resources/sass/auth/auth.scss', 'resources/js/auth/auth.js'])
@endsection
@section('main_container')
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
                        Sign Up Your Account
                    </div>
                    <br />
                    @if (session('error'))
                        <x-notification.badge-message class="mt-2" messages="{{ session('error') }}" type="danger"
                            textAlign="center" />
                    @endif

                    <span style="color: red; font-weight: 600">{{ $errors->first('password') }}</span>

                    <form method="POST" action="{{ route('register.store') }}"
                        onsubmit="submit_disabled(document.getElementById('login_submit'))">
                        @csrf
                        <input type="text" value="{{$token}}" id="token" name="token" hidden />
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
                        <p class="" id="demo"></p>
                        <button class="btn btn-primary" type="submit" id='login_submit'>Submit</button>
                    </form>
                </div>


            </div>

        </div>
    @endsection
    @section('script_js')
        <script>
            // console.log(countDownDate)   
            console.log(1)

            setTimeout(() => {

                let countDownDate = new Date("{{ $expired_date }}");

                countdown(countDownDate)

            }, 1000);

        </script>
    @endsection
