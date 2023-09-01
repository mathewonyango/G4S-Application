@extends('layout.default')

@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Income Management</a></li>

            </ol>
        </nav>
        
        <legend>Filter Reports</legend>
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                TOTAL AMOUNT</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$total_amount}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    @if(count($all_incomes))
    <br><br>
    <div class="float-right mt-1">
        <form action="{{ route('report.get-income')}}" method="get">
            <div class="text-center">
                <div class="form-group row mb-3">
                    <label for="cogc" class="col-3 col-form-label">From:</label>
                    <div class="col-9">
                        <input type="datetime-local" class="form-control" id="cogc" name="start_date" placeholder="start date">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="cogc" class="col-3 col-form-label">To:</label>
                    <div class="col-9">
                        <input type="datetime-local" class="form-control" id="cogc" name="end_date" placeholder="End date.">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Filter data">
                    <a class="btn btn-warning" href="{{ route('report.income') }}">Export Data</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('content')
@include('flash::message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
<div class="table-responsive">
  
    <table class="table-hover table m-0 align-items-center table-flush table-sm" width="100%">

        <thead>
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Type of ncome</th>
                <th>M-pesa Code</th>
                <th>Amount</th>
                <th>Trip Number</th>
                {{-- <th>BillRefNumber</th>
                                    <th>OrgAccountBalance</th> --}}
                <th>Date Registered </th>



            </tr>
        </thead>
        <tbody>
            @foreach($all_incomes as $income)
            <tr>
                <td>{{ ucwords($income->FirstName .' '. $income->LastName) }}</td>
                <td>{{ $income->MSISDN }}</td>
                <td>{{ ucwords($income->TransactionType) }}</td>
                <td>{{ ucwords($income->TransactionID) }}</td>
                {{-- <td>{{ ucwords($income->incomeTime) }}</td> --}}
                <td>{{ ucwords($income->TransactionAmount) }}</td>
                <td>{{ ucwords($income->Id) }}</td>
                {{-- <td>{{ ucwords($income->BillRefNumber) }}</td>
                <td>{{ ucwords($income->OrgAccountBalance) }}</td>--}}
                <td>{{ \Carbon\Carbon::parse($income->CreatedAt)->format('d-m-Y / h:i:s A')}}
                </td>
                {{-- <td>{{ ucwords($income->Status) }}</td> --}}
                {{-- @if ($income->Status==1)
                                         {
                                             <td><div class ="badge bg -success text wrap">
                                                 paid
                                             </td></div>
                                         }
                                         @else
                                         {
                                            <td><div class ="badge bg -success text wrap">
                                                unpaid
                                            </td></div>    
                                         }
                                         @endif --}}

            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $all_incomes->links() !!}

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
@include('modals.modal-delete')
@endsection

@section('script')
@include('scripts.delete-modal-script')
@endsection