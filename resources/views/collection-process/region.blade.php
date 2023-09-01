@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Region Management</a></li>
                </ol>
            </nav>
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
                            <h4 class="header-title mt-0 mb-1">Administrative Module</h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('corporate.index-region') }}"
                               class="btn btn-sm btn-soft-primary float-right mr-2"
                               data-toggle="tooltip" data-placement="top"
                               title="Add Region">
                                <i class="uil uil-plus"></i> Add Region
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if(count($regions))
                        <table class="table table-hover table-striped align-items-center">
                            <thead>
                            <tr>
                                <th class="number-column">#</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($regions as $key => $region)
                                <tr>
                                    <td class="number-column">{{ $key + 1 }}</td>
                                    <td>{{ ucwords($region->town_name) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $regions->links() }}
                        </div>
                    @else
                        <div class="alert alert-secondary">
                            No records found
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('modals.modal-delete')
@endsection

@section('style')
    <style>
        .number-column {
            padding-top: 5px;
        }
    </style>
@endsection

@section('script')
    @include('scripts.delete-modal-script')
@endsection
