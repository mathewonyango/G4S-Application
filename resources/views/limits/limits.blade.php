@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Customers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Customer Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Add customer Limits</h4>
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
                            <h4 class="header-title mt-0 mb-1">New Limits</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="
                       {{-- //     {{ route('location.create') }} --}}
                            " method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="locationName" class="col-3 col-form-label">Select Transaction</label>
                                    <div class="col-9">
                                        <select class="form-control" id="group account number" placeholder="Search by Customer Number"
                                               required value="{{ old('name') }}" name="transaction">
                                               <option>--Select--</option>
                                               <option value="B2C">B2C - Withdrawal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="locationName" class="col-3 col-form-label">Daily Limit</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="group account number" placeholder="Daily Limit"
                                               required value="{{ old('name') }}" name="name">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="locationName" class="col-3 col-form-label">Transaction Limit</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="group account number" placeholder="Transaction Limit"
                                               required value="{{ old('name') }}" name="name">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-location-arrow"></i> Save</button>
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
