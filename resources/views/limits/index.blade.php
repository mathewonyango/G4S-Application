@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Limit Management</a></li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">User Management</li> --}}
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Limits</h4>
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
                            <h4 class="header-title mt-0 mb-1">Limit Management</h4>
                        </div>

                    </div>
                </div>

                <div class="table-responsive">
                    @if (count($limits))
                        <table class="table-hover table m-0 align-items-center table-flush" width="100%">
                            <thead>
                                <tr>
                                    <th>Daily Limit</th>
                                    <th>Transaction Limit</th>
                                    <th>Edit Limit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($limits as $limit)
                                    <tr>
                                        <td>{{ $limit->DailyLimit }}</td>
                                        <td>{{ $limit->TransactionLimit }}</td>
                                        <td class="text"><a href="{{ route('limits.edit', $limit->id) }}"
                                                title="Edit Limit" class="btn btn-outline-primary btn-sm"
                                                data-toggle="tooltip">Edit/Set Limit
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <br>
                        <div class="row">
                            <div class="alert alert-secondary container-fluid">
                                No Limits set
                            </div>
                            <div class="col-lg-6">
                                <a href=" {{ route('limits.create') }}" class="btn btn-sm btn-soft-primary float-right  mr-2" data-toggle="tooltip"  data-placement="top" title="Add User">
                                    <i class="uil uil-plus"> Add New Limit</i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
