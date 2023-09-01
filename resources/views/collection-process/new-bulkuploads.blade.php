@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Pesalink</a></li>
                    <li class="breadcrumb-item"><a href="">Transactions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaction Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Initiate  Bulk Transaction</h4>
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
                            <h4 class="header-title mt-0 mb-1">Upload Management</h4>
                        </div>
                        
                    </div>
                </div>
                {{-- {{ dd($newaccounts) }} --}}

                <div class="table-responsive">
                    @if (count($newaccounts))
                        <table class="table table-striped table-sm table-danger">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Batch No</th>
                                    <th>file Name </th>
                                    <th>Date upload </th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newaccounts as $f)
                                    <tr>
                                       <td>{{ $loop->iteration }}</td>
                                        <td>{{ $f->batch_id }}</td>
                                        <td>{{ $f->original_file_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($f->created_at)->format('d-m-Y / h:i:s A')}}</td>
                                        
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{ route('psl-section.showdetails',$f->id) }}" method="get">
                                            @csrf
                                            <button class="btn btn-outline-primary btn-sm mr-2">View</button>
                                        </form>
                                                <form method="POST" action="{{ route('psl-section.approvebulk',$f->id) }}"  onSubmit="approveButton.disabled = true; return true;">
                                                    @csrf
                                                    <input type="hidden" name="batch_id" value="{{ $f->batch_id }}">
                                                   

                                                <button type="submit" class="btn btn-success btn-sm mr-2"  onclick= "return confirm('Are you sure you want to Approve?');" name="approveButton">Approve</button>
                                                </form>
                                                <form method="POST" action="{{ route('psl-section.rejectbulk',$f->id) }}">
                                                    @csrf
                                                  <!-- <input type="hidden" name="batch_id" value="{{ $f->batch_id }}"> -->
                                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure you want to Reject?');">Reject</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>#</th>
                                <th>#</th>
                                    <th>Batch No</th>
                                    <th>file Name </th>
                                    <th>Date upload </th>
                                    <th class="text-center">Action</th>

                                </tr>
                            </tfoot>
                        </table>
                        {{-- {!! $newaccounts->links() !!} --}}
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
