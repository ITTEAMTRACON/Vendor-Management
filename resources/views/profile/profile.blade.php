@extends('index')
@section('title', 'Profile')
@section('main_container')
    @include('components.header')
    @include('components.sidebar')
    @vite(['resources/sass/profile/profile.scss'])



    <div class="container-style">
        <header>
            Profile
        </header>



        <div class="card profile">
            <div class="nav-menu">
                <div class="col-md-6 nav-item active">
                    General Information
                </div>
                <div class="col-md-6 nav-item">
                    Contact Person
                </div>
            </div>

            <br><br>
            <form>
                <div class="col-md-12" style="display: flex">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="vendor_name" class="col-sm-4 col-form-label">Vendor Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="vendor_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="business_type" class="col-sm-4 col-form-label">Business Type</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="business_type">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label">Address (as on Tax Invoice)</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" id="address"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-sm-4 col-form-label">Country</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="country">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-sm-4 col-form-label">City</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="city">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="phone">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facsimile" class="col-sm-4 col-form-label">Facsimile</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="facsimile">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-sm-4 col-form-label">Website</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="website">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postal_code" class="col-sm-4 col-form-label">Postal Code</label>
                            <div class="col-sm-8">
                                <input type="postal_code" class="form-control" id="email">
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="col-md-12">
                    <div class="text-right">
                        <button class="btn btn-info">Cancel</button>
                        <button class="btn btn-success">Save</button>
                        <button class="btn btn-warning">Edit</button>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection
