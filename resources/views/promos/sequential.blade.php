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
            <h4 class="mb-1 mt-0">Generate Sequential Promo</h4>
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
                            <h4 class="header-title mt-0 mb-1">New Promo</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('promo.post-promo-sequential') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Promo Name</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="name"
                                           placeholder="Type voucher or Promo Name">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <select class="form-control" name="applies_to" required>
                                                <option>Select Group Applies to</option>
                                                <option value="CORPORATE_STAFF">Corporate Client</option>
                                                <option value="CLIENT">Normal Client</option>
                                                <option value="ALL">All</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Amount (In Kshs)</label>
                                    <input type="number" class="form-control" id="formGroupExampleInput2" name="amount"
                                           placeholder="Value ">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Start Date</label>
                                    <input type="datetime-local" class="form-control" id="formGroupExampleInput2"
                                           placeholder="Days Valid" name="start_date">

                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Expiry Date</label>
                                    <input type="datetime-local" class="form-control" id="formGroupExampleInput2"
                                           placeholder="Days Valid" name="expiry">
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i
                                            class="uil uil-location-arrow"></i> Generate</button>
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
