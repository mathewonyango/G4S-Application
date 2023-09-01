@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Limits</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Limit Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Limit Edit</h4>
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
                            <h4 class="header-title mt-0 mb-1">New Edit</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('limits.edit', $limit->id) }}" method="post">
                                @csrf
                                <input hidden value="440000" name="ProcessingCode">
                                <div class="form-group row mb-3">
                                    <label for="firstName3" class="col-3 col-form-label">Daily  Limit</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="firstName3" placeholder="Daily Limit"
                                               required value="{{ old('DailyLimit', $limit->DailyLimit) }}" name="DailyLimit">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="phoneNumber" class="col-3 col-form-label">Transaction Limit</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control"
                                               placeholder="Transaction Limit"
                                               required value="{{ old('TransactionLimit', $limit->TransactionLimit) }}" name="TransactionLimit">
                                    </div>
                                </div>


                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-location-arrow"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
