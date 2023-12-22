@extends('index')
@section('title', 'Add - QHSE')

@section('main_container')
    @include('components.header')
    @include('components.sidebar')
    @vite(['resources/js/qhse/qhse.js'])

    <div class="container-style">
        <header>
            <div
                style="display: flex; vertical-align: middle; align-content: center; align-items: center; align-self: center">
                <a href="{{ route('qhse.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg>
                </a>
                &nbsp;&nbsp;
                <label>QHSE Add</label>
            </div>
        </header>
        </header>


        <div class="card" style="height: 100vh">
            <div class="card-body" style="height: 100vh">
                <iframe
                    src="https://dev-tumbler.tracon.co.id/form-answer/{{ $survey_slug->SURVEY_SLUG }}/{{ $crypt_email }}/{{ $crypt_last_login }}"
                    name="iframe" style="width: 100%; height: 100%"></iframe>
                {{-- <iframe src="http://localhost:5173/form-answer/{{$survey_slug->SURVEY_SLUG}}/{{ $crypt_email }}/{{ $crypt_last_login }}" name="iframe" style="width: 100%; height: 100%"></iframe> --}}
            </div>
        </div>

    </div>
@endsection
