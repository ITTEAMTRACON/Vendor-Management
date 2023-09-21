@extends('index')
@section('title', 'Detail - Pre-Qualification')

@section('main_container')
@include('components.header')
@include('components.sidebar')
    @vite(['resources/js/prequalification/prequalification.js'])

    <div class="container-style">
        <header>
            Pre-Qualification Detail
        </header>

        <div class="progress-graph">
            <div>
                <span class="circle active"><span class="title">Proposed</span><span class="desc">Project Control</span></span>
                <span class="line active"></span>
                <span class="circle active"><span class="title">Waiting Approval</span><span class="desc">Progress Control Manager</span></span>
                <span class="line"></span>
                <span class="circle"><span class="title">Approved</span><span class="desc">General Manager PMO</span></span>
            </div>
        </div>


        <div class="card" style="height: 100vh">
            <div class="card-body" style="height: 100vh">
                <iframe src="https://tumbler.tracon.co.id/form-answer/dev-sub-question" name="iframe" style="width: 100%; height: 100%"></iframe>
            </div>
        </div>

    </div>
@endsection
