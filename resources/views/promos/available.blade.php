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
            <h4 class="mb-1 mt-0">Available Promo</h4>
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
                            <h4 class="header-title mt-0 mb-1">Available Promo</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Promotion Name</th>
                                    <th scope="col">Promo Code/Voucher</th>
                                    <th scope="col">Applicable Category</th>
                                      <th scope="col">Amount Value(KES)</th>
                                      <th scope="col"> <center>Expiry Date and Time</center></th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach( $all_promos as $key=>$promo)
                                  <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{ $promo->name }}</td>
                                      <td>{{ $promo->promo_code }}</td>
                                      <td>{{ $promo->applies_to }}</td>
                                      <td>{{ $promo->amount }}</td>
                                      <td>{{  \Carbon\Carbon::parse($promo->expiry)->format('Y-m-d H:i:s') }}</td>
{{--                                      <td>{{   date_format($promo->expiry,"Y/m/d H:i:s")}}</td>--}}

                                  </tr>

                                </tbody>
                                @endforeach
                              </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
