@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Pesalink</a></li>
                    <li class="breadcrumb-item"><a href="">Transactions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaction Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Initiate Bulk Transfer</h4>
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
                            {{-- <h4 class="header-title mt-0 mb-1">New User</h4> --}}
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary float-right" rel="tooltip"
                                data-placement="top" title="Back to Listing">
                                <i class="uil uil-arrow-left"> Back Home</i>
                            </a>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('psl-section.bulktransfers') }}" method="GET">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="firstName3" class="col-3 col-form-label">Customer Number</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="firstName3"
                                            placeholder="Type Customer Number" required name="acc_number">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="role" class="col-3 col-form-label">Select Credit Type
                                    </label>
                                    <div class="col-9">
                                        <Select id="cred" class="form-group custom-select"  name="credit_type" required>
                                            <option value="">-- Choose --</option>
                                            <option value="acc">A/C Number</option>
                                        </Select>
                                        <br />
                                    </div>
                                <br />

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-search"></i>
                                        Proceed</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
@endsection
