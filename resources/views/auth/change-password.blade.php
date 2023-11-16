@extends('index')
@section('title', 'Change Password')
@section('main_container')
    @include('components.header')
    @include('components.sidebar')
    {{-- @vite(['resources/sass/profile/profile.scss', 'resources/js/profile/profile.js']) --}}



    <div class="container-style">
        <header>
            Change Password
        </header>


        @if (session('status') == 'password-updated')
            <x-notification.badge-message class="mt-2" messages="Password updated successful" type="success" />
        @elseif(count($errors) > 0)
            <x-notification.badge-message class="mt-2" messages="Password updated failed" type="danger" />
        @endif

        <div class="card" style="padding: 10px; width: 50vw; margin: auto">
            {{-- {{$errors}} --}}

            <form method="post" action="{{ route('password.update') }}"
                onsubmit="submit_disabled(document.getElementById('btn_submit'))">
                @csrf
                @method('put')
                <div class="form-group row">
                    <label for="current_password" class="col-sm-4 col-form-label">Current Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" name="password">
                        <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-4 col-form-label">Confirm New Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
                    </div>
                </div>

                <br>
                <button type="submit" id="btn_submit" class="btn btn-success" style="width: 100%">Save</button>
                <div class="flex items-center gap-4">
                    {{-- <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                        class="text-sm text-gray-600 dark:text-gray-400" style="color: green">Save Successful</p> --}}
                    @if (session('success'))
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm text-gray-600 dark:text-gray-400" style="color: green">{{ session('success') }}</p>
                    @elseif(session('error'))
                        <p x-data="{ show: true }" x-show="show" x-transition
                            class="text-sm text-gray-600 dark:text-gray-400" style="color: red">{{ session('error') }}</p>
                    @endif
                </div>
            </form>


        </div>

    </div>
@endsection
