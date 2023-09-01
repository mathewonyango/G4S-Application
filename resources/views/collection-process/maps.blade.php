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
            <h4 class="mb-1 mt-0">Administrators</h4>
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

                            <h4 class="header-title mt-0 mb-1">Available Maps </h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('corporate.showAddMap') }}"
                               class="btn btn-sm btn-soft-primary float-right mr-2"
                               data-toggle="tooltip" data-placement="top"
                               title="Add User">
                                <i class="uil uil-plus"></i> Add Map
                            </a>

                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if(count($maps))
                        <table class="table table-hover table-striped align-items-center">
                            <thead>
                            <tr>
                                <th class="number-column">#</th>
                                <th>FROM</th>
                                <th>TO</th>
                                <th>PRICE</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($maps as $key => $map)
                                <tr>
                                    <td class="number-column">{{ $key + 1 }}</td>
                                    <td>{{ ucwords(getRegionName($map->from)) }}</td>
                                    <td>{{ ucwords(getRegionName($map->to)) }}</td>
                                    <td>{{ ucwords($map->price) }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $maps->links() }}
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
