@extends('index')
@section('title', 'Pre-Qualification')
@section('main_container')
    @include('components.header')
    @include('components.sidebar')
    @vite(['resources/js/prequalification/prequalification.js'])

    <div class="container-style">
        <header>
            Pre-Qualification
        </header>

        <button class="btn btn-add">Add New Pre-Qualification</button>
        <br>
        <br>

        <div class="card">
            <div class="card-body">
                <table id="example" class="display border" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Status Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>22 Ap 2020</td>
                            <td value="DRAFT">DRAFT</td>
                            <td>02 Jun 2020 | 11:32</td>
                            <td class="action">
                                <div>
                                    <a href="#edit"><x-svg.edit /></a> 
                                    <a href="#delete"><x-svg.delete /></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>22 Ap 2020</td>
                            <td value="REJECTED">REJECTED</td>
                            <td>02 Jun 2020 | 11:32</td>
                            <td class="action">
                                <div>
                                    <a href="#edit"><x-svg.edit /></a> 
                                    <a href="#delete"><x-svg.delete /></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>22 Ap 2020</td>
                            <td value="WAITING FOR REVIEW">WAITING FOR REVIEW</td>
                            <td>02 Jun 2020 | 11:32</td>
                            <td class="action">
                                <div>
                                    <a href="#edit"><x-svg.eye /></a> 
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>22 Ap 2020</td>
                            <td value="APPROVED">APPROVED</td>
                            <td>02 Jun 2020 | 11:32</td>
                            <td class="action">
                                <div>
                                    <a href="{{route('prequalification.detail')}}"><x-svg.eye /></a> 
                                </div>
                            </td>
                        </tr>
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
