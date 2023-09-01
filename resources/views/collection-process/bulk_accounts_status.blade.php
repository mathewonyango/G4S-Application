@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Pesalink</a></li>
                    <li class="breadcrumb-item"><a href="">Bulk Transactions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bulk Transaction Management</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    @if (count($info))
                        <table class="table table-striped table-sm table-danger">
                            <thead>
                                <tr class="text-center text-dark font-weight-bold">
                                    <th>#</th>
                           
                                    <th>Bank Code</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Credit A/c</th>
                                    <th>Amount</th>
                                    <th>Debit A/C</th>
                                    <th>FT Ref</th>
                                    <th>Creditor Name</th>
                                    <th>Status</th>
                                    <th>CBS Status</th>
                                    <th>Pesalink Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($info as $action)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                    
                                        <td>{{ $action->bank_code }}</td>
                                        <td>{{ $action->customer_name }}</td>
                                        <td>{{ $action->phone_number }}</td>
                                        <td>{{ $action->account_to }}</td>
                                        <td>{{ $action->amount }}</td>
                                        <td>{{ $action->account_from }}</td>
                                        <td>{{ $action->ft_reference }}</td>
                                        <td>{{ $action->creditor_name }}</td>
                                        @if ($action->status == '0')
                                            <td>Pending</td>
                                        @elseif($action->status == '3')
                                            <td>Failed to debit Core</td>
                                        @elseif($action->status == '6')
                                            <td>Rejected from IPSL<td>
                                            @elseif($action->status == '7')
                                            <td>Rejected by Checker</td>
                                        @elseif($action->status == '8')
                                            <td>Reversed on Core</td>
                                        @elseif($action->status == '2')
                                            <td>Successful on Core</td>
                                         @elseif($action->status == '5')
                                            <td>T24 Pending Authorization</td>
                                        @endif
                                        <td>{{strtolower($action->cbs_status) }}</td>
                                        <td>{{ $action->pesalink_status }}</td>
                                       
                                        <td>
                                        @if ($action->pesalink_status == 'ACCP')
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <form action="{{ route('psl-section.printreceipt') }}" method="GET">
                                                        @csrf
                                                        <input type="hidden" value="{{ $action->id }}" name="id"/>
            
                                                    <button type="submit" class="btn btn-outline-primary btn-sm"> <i class="uil uil-print"></i>Print Receipt</button>
                                                    </form>
                                        </div>
                                        </td>
                                        @else
                                        <td>{!! status_label('unsuccessful') !!}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $info->links() !!}
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
