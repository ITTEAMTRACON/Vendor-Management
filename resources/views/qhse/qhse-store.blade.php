@extends('index')
@section('title', 'Add - QHSE')

@section('main_container')
@include('components.header')
@include('components.sidebar')
    @vite(['resources/js/qhse/qhse.js'])

    <div class="container-style">
        <header>
            QHSE Add
        </header>


        <div class="card" style="height: 100vh">
            <div class="card-body" style="height: 100vh">
                <iframe src="https://tumbler.tracon.co.id/form-answer/{{$survey_slug->SURVEY_SLUG}}/{{ $crypt_email }}/{{ $crypt_last_login }}" name="iframe" style="width: 100%; height: 100%"></iframe>
            </div>
        </div>

    </div>
@endsection
