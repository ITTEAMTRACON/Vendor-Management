@extends('index')
@section('title', 'Detail - QHSE')

@section('main_container')
@include('components.header')
@include('components.sidebar')
    @vite(['resources/js/qhse/qhse.js'])

    <div class="container-style">
        <header>
            QHSE Detail
        </header>

        <div class="progress-graph">
            @if($SESSION->SESSION_STATUS == null)
                <div>
                    <span class="circle active"><span class="title">Proposed</span><span class="desc">Project Control</span></span>
                    <span class="line active"></span>
                    <span class="circle active"><span class="title">Waiting Approval</span><span class="desc">Progress Control Manager</span></span>
                    <span class="line"></span>
                    <span class="circle"><span class="title">Approved</span><span class="desc">General Manager PMO</span></span>
                </div>
            @elseif($SESSION->SESSION_STATUS == "REJECTED")
                <div class="rejected">
                    <span class="circle active"><span class="title">Proposed</span><span class="desc">Project Control</span></span>
                    <span class="line active"></span>
                    <span class="circle active"><span class="title">Rejected</span><span class="desc">Progress Control Manager</span></span>
                    <span class="line"></span>
                    <span class="circle"><span class="title">Approved</span><span class="desc">General Manager PMO</span></span>
                </div>
            @endif
    
        </div>


        <div class="card" style="height: 100vh">
            <div class="card-body" style="height: 100vh">
                {{-- <iframe src="https://tumbler.tracon.co.id/answer-detail/{{$SESSION->SURVEY_SLUG}}/{{$crypt_email}}/{{$crypt_last_login}}/{{ $SESSION_UUID }}" name="iframe" style="width: 100%; height: 100%"></iframe> --}}
                <iframe src="http://localhost:5174/answer-detail/{{$SESSION->SURVEY_SLUG}}/{{$crypt_email}}/{{$crypt_last_login}}/{{ $SESSION_UUID }}" name="iframe" style="width: 100%; height: 100%"></iframe>
            </div>
        </div>

    </div>
@endsection
