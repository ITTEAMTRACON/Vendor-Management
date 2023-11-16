@extends('index')
@section('title', 'Detail - Pre-Qualification')

@section('main_container')
    @include('components.header')
    @include('components.sidebar')
    @vite(['resources/js/prequalification/prequalification.js'])

    <div class="container-style">
        <header>
            <div style="display: flex; vertical-align: middle; align-content: center; align-items: center; align-self: center">
                <a href="{{route('prequalification.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                </a>
                &nbsp;&nbsp;
                <label>Pre-Qualification Detail</label>
            </div>
            
        </header>

        <div class="progress-graph" hidden>
            @if ($SESSION->SESSION_STATUS == null)
                <div>
                    <span class="circle active"><span class="title">Proposed</span>
                        {{-- <span class="desc">Project Control</span> --}}
                    </span>
                    <span class="line active"></span>
                    <span class="circle active"><span class="title">Waiting Approval</span>
                        {{-- <span class="desc">Progress Control Manager</span> --}}
                    </span>
                    <span class="line"></span>
                    <span class="circle"><span class="title">Approved</span>
                        {{-- <span class="desc">General Manager PMO</span> --}}
                    </span>
                </div>
            @elseif($SESSION->SESSION_STATUS == 'APPROVED')
                <div>
                    <span class="circle active"><span class="title">Proposed</span>
                        {{-- <span class="desc">Project Control</span> --}}
                    </span>
                    <span class="line active"></span>
                    <span class="circle active"><span class="title">Waiting for Review</span>
                        {{-- <span class="desc">Progress Control Manager</span> --}}
                    </span>
                    <span class="line active"></span>
                    <span class="circle active"><span class="title">Approved</span>
                        {{-- <span class="desc">General Manager PMO</span> --}}
                    </span>
                </div>
            @elseif($SESSION->SESSION_STATUS == 'REJECTED')
                <div class="rejected">
                    <span class="circle active"><span class="title">Proposed</span>
                        {{-- <span class="desc">Project Control</span> --}}
                    </span>
                    <span class="line active"></span>
                    <span class="circle active"><span class="title">Rejected</span>
                        {{-- <span class="desc">Progress Control Manager</span> --}}
                    </span>
                    <span class="line"></span>
                    <span class="circle"><span class="title">Approved</span>
                        {{-- <span class="desc">General Manager PMO</span> --}}
                    </span>
                </div>
            @endif

        </div>


        <div class="card" style="min-height: 100vh">
            <div class="card-body" style="height: 100vh">
                <iframe src="https://tumbler.tracon.co.id/answer-detail/{{$SESSION->SURVEY_SLUG}}/{{$crypt_email}}/{{$crypt_last_login}}/{{ $SESSION_UUID }}" name="iframe" style="width: 100%; height: 100%"></iframe>
                {{-- <iframe
                    src="http://localhost:5174/answer-detail/{{ $SESSION->SURVEY_SLUG }}/{{ $crypt_email }}/{{ $crypt_last_login }}/{{ $SESSION_UUID }}"
                    name="iframe" style="width: 100%; height: 100%"></iframe> --}}
                    name="iframe" style="width: 100%; height: 100%"></iframe> --}}


            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Approval History
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                    @foreach ($approval_history as $row)
                        <tr>
                            <td>{{ $row->APR_APPROVED_BY_NAME }}</td>

                            @if ($row->APR_STATUS == null || $row->APR_STATUS == 'WAITING FOR REVIEW')
                                <td value="WAITING FOR REVIEW">WAITING FOR REVIEW</td>
                            @elseif($row->APR_STATUS == 'REJECTED')
                                <td value="REJECTED">REJECTED</td>
                            @elseif($row->APR_STATUS == 'APPROVED')
                                <td value="APPROVED">APPROVED</td>
                            @elseif($row->APR_STATUS == 'PROPOSED')
                                <td value="PROPOSED">PROPOSED</td>
                            @else
                                <td value="-">-</td>
                            @endif

                            <td>
                                @if ($row->APR_UPDATED_AT == null)
                                    {{ $row->APR_CREATED_AT }}@else{{ $row->APR_UPDATED_AT }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection
