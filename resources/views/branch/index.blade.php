@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Branch</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Branch Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Branches</h4>
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
                            <h4 class="header-title mt-0 mb-1">Branches List</h4>
                        </div>
                        <div class="col-lg-6">
                            @can('create_branch')
                                <button type="button" rel="tooltip"
                                        class="btn btn-sm btn-soft-primary float-right"
                                        title="Create Branch"
                                        data-placement="top" data-toggle="modal"
                                        data-target="#branchModalCenter" data-title="Add Branch">
                                    <i class="uil uil-plus"></i>
                                    Create Branch
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    @if(count($branches))
                        <table class="table-hover table m-0 align-items-center table-flush" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($branches as $branch)
                                <tr>
                                    <td>{{ ucwords($branch->names) }}</td>
                                    <td>{{ $branch->code }}</td>
                                    <td>{{ $branch->created_at }}</td>
                                    {{-- <td class="text">
                                        @can('manage_branch')
                                            <a href="#" title="delete branch" class="btn btn-outline-danger btn-sm" rel="tooltip"
                                               data-placement="top"><i class="uil uil-trash-alt"></i>
                                            </a>
                                        @endcan
                                    </td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Created At</th>
                            </tr>
                            </tfoot>
                        </table>
                        {!! $branches->links() !!}
                    @else
                        <br>
                        <div class="row">
                            <div class="alert alert-info container-fluid">
                                No records found
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('modals.add-branch')
@endsection
