@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Promo</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Promo Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Validate Promo</h4>
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
                            <h4 class="header-title mt-0 mb-1">Validate the Code</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('users.addusers') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Promo Code</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        placeholder="Type promo/voucher number">
                                </div>


                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i
                                            class="uil uil-location-arrow"></i> Validate</button>
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
