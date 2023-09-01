@extends('layout.default')

@section('breadcrumb')
<div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Pesalink Web</a></li>
                    <li class="breadcrumb-item active"><a href="javascript: void(0);">Bulk Transfer</a></li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">New Upload</h4>
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
                            <h4 class="header-title mt-0 mb-1">File Upload</h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary float-right"
                               rel="tooltip" data-placement="top"
                               title="Back to Listing">
                                <i class="uil uil-arrow-left"> Back to Listing</i>
                            </a>
                        </div>
                    </div>
                    <br>

                    {{-- {{ dd($company) }} --}}

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('psl-section.bulkaccounts') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row mb-3">
                                    <label for="" class="col-3 col-form-label"></label>
                                    <div class="alert alert-danger col-9">
                                    <span
                                        style="font-weight: 100;">Excel sheet must be in the following formats:xlsx|xls|csv</span>

                                        <a class="text-dark font-weight-bold mt-2 d-block" href="{{ asset('uploads/Pesalink_template.xlsx') }}"> <i
                                                class="fa fa-download"></i> Download Sample Excel</a>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="file" class="col-3 col-form-label">File</label>
                                    <div class="col-9">
                                        <input type="file" required class="form-control" name="file" id="file"
                                            placeholder="File">
                                    </div>
                                </div>

                                <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- <form action="{{ route('customer.customer-search') }}" method="GET"> --}}
                                    {{-- @csrf --}}
                                    <a class="btn btn-primary mr-2 btn-sm text-white" data-toggle="modal"
                                        data-target="#enterPassword">Complete
                                    </a>

                                    <div class="modal fade modal-danger" id="enterPassword" role="dialog"
                                        aria-label="enterPasswordModal" aria-hidden="true" tabindex="-1">
                                        <div class="modal-dialog modal-confirm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                </div>
                                                <div class="modal-body">
                                                    <p>Please enter your password to confirm action.</p>
                                                    <input type="password" class="form-control hidden" id="password"
                                                        autocomplete="false" name="password" required>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal" aria-hidden="true">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" id="submit"
                                                        class="btn btn-success success btn-sm" aria-hidden="true">
                                                        <i class="uil uil-check"></i>
                                                        Confirm
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{ route('psl-section.initiate') }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                </form>
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
