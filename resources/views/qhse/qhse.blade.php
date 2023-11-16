@extends('index')
@section('title', 'Pre-Qualification')
@section('main_container')
    @include('components.header')
    @include('components.sidebar')
    @vite(['resources/js/qhse/qhse.js'])


    <div class="container-style">
        <header>
            QHSE
        </header>

        <a class="btn btn-add" href="{{ route('qhse.store') }}">Add New QHSE</a>
        <br>
        <br>
        <div class="card">
            <div class="card-body">
                <table id="example" class="display border hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>QHSE Date</th>
                            <th>Status</th>
                            <th>Status Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($session as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->created_date }}</td>
                                @if ($row->SESSION_STATUS == null)
                                    <td value="WAITING FOR REVIEW">WAITING FOR REVIEW</td>
                                @elseif($row->SESSION_STATUS == 'REJECTED')
                                    <td value="REJECTED">REJECTED</td>
                                @elseif($row->SESSION_STATUS == 'APPROVED')
                                    <td value="APPROVED">APPROVED</td>
                                @else
                                    <td value="-">-</td>
                                @endif
                                <td>
                                    @if ($row->SESSION_UPDATE_AT == null)
                                        {{ $row->created_date }}@else{{ $row->updated_date }}
                                    @endif
                                </td>
                                <td class="action">
                                    <div>
                                        @if ($row->SESSION_STATUS == null)
                                            <a
                                                href="{{ route('qhse.detail', $row->SESSION_UUID) }}"><x-svg.eye /></a>
                                        @elseif($row->SESSION_STATUS == 'REJECTED')
                                            <a
                                                href="{{ route('qhse.detail', $row->SESSION_UUID) }}"><x-svg.edit /></a>
                                            <a href="#delete"><x-svg.delete /></a>
                                        @elseif($row->SESSION_STATUS == 'APPROVED')
                                            <a
                                                href="{{ route('qhse.detail', $row->SESSION_UUID) }}"><x-svg.eye /></a>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Status Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>

    </div>
@endsection
