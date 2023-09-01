@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Push Notifications</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Notifications Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Create A Push Notification</h4>
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
                            <h4 class="header-title mt-0 mb-1">Write Push Notification</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('sms.send-push') }}" method="post">
                                @csrf
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
                                <div class="form-group row mb-3">
                                    <label for="gender" class="col-3 col-form-label">Send to</label>
                                    <div class="col-9">
                                        <select class="form-control" id="gender" name="category">
                                            <option value="1">All Users</option>
                                            <option value="2">Riders</option>
                                            <option value="3">Normal Customers</option>
                                            <option value="4">Corporate Clients</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i
                                            class="uil uil-location-arrow"></i> Send Push Notification</button>
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
