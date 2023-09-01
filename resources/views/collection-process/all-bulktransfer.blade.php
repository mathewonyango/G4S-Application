@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Loans</a></li>
                    <li class="breadcrumb-item"><a href="">Loans</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Loan Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Loans</h4>
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">Loan Management</h4>
                        </div>
                    </div>
                </div>
                {{-- {{ dd($fetched) }} --}}

                <div class="table-responsive">
                    @if (count($loans))
                        <table class="table table-striped table-sm table-danger">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer No</th>
                                    <th>Customer Name</th>
                                    <th>Phone Number</th>
                                    <th>Amount</th>
                                    <th>Period</th>
                                    <th>Status</th>
                                    <th>CRB Status</th>
                                    <th>Date Applied</th>
                                </tr>
                            </thead>
                            {{-- {{ dd($loans) }} --}}
                            <tbody>
                                @foreach ($loans as $f)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $f->customerNumber }}</td>
                                        <td>{{ $f->customerName }}</td>
                                        <td>{{ $f->phoneNumber }}</td>
                                        <td>{{ $f->amount }}</td>
                                        <td>{{ $f->period }}</td>
                                        <td>{{ $f->status }}</td>
                                        <td>{{ $f->cbsStatus }}</td>
                                        <td>{{ $f->createdAt }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Customer No</th>
                                    <th>Customer Name</th>
                                    <th>Phone Number</th>
                                    <th>Amount</th>
                                    <th>Period</th>
                                    <th>Status</th>
                                    <th>CRB Status</th>
                                    <th>Date Applied</th>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <br>
                        <div class="row">
                            <div class="alert alert-secondary container-fluid">
                                No records found
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
