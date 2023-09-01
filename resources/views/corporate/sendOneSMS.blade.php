@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">SMS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Corporate SMS Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Write SMS</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">Write SMS</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('rider.add-rider') }}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="firstname" class="col-3 col-form-label">Phone Number</label>
                                    <div class="col-9">
                                            <input type="title" class="form-control"  name="phone_number" placeholder="+2547....">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="firstname" class="col-3 col-form-label">Title</label>
                                    <div class="col-9">
                                        <input type="title" class="form-control"  name="title" placeholder="Title">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="message" class="col-3 col-form-label">Message</label>
                                    <div class="col-9">
                                        <textarea  class="form-control" name="message"  rows="4" cols="50" placeholder="Type the message"></textarea>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i
                                            class="uil uil-location-arrow"></i> Confirm & Send SMS</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
