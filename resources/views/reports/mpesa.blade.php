@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Report Management</a></li>

                </ol>
            </nav>
            <br><br>    
            @if(count($all_transactions))
            <h4 class="mb-1 mt-0">Transactions</h4>   
              </div>
              <form action="{{ route('report.statements') }}" method="get">
                <div class="text-center">
                 <div class="form-group row mb-3">
                   <label for="cogc" class="col-3 col-form-label">From</label>
                   <div class="col-9">
                       <input type="datetime-local" class="form-control" id="cogc" name="start_date"
                           placeholder="start date">
                   </div>
               </div>
               <div class="form-group row mb-3">
                   <label for="cogc" class="col-3 col-form-label">To</label>
                   <div class="col-9">
                       <input type="datetime-local" class="form-control" id="cogc" name="end_date"
                           placeholder="End date.">
                   </div>
               </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Filter data">
                  <a class="btn btn-warning" href="{{ route('report.export') }}">Export Data</a>
                 </div>
             </div>
            </form> 
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
                                <th>Transaction Mode</th>
                                <th>Transaction Id</th>
                                <th>Amount</th>
                                <th>Trip Number</th>
                                <th>Registered on</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_transactions as $transaction)
                                <tr>
                                    <td>{{ ucwords($transaction->FirstName .'   '.$transaction->MiddleName) }}</td>
                                    <td>{{ $transaction->MSISDN }}</td>
                                    <td>{{ ucwords($transaction->TransactionType) }}</td>
                                    <td>{{ ucwords($transaction->TransactionID) }}</td>
                                    <td>{{ ucwords($transaction->TransactionAmount) }}</td>
                                    <td>{{ ucwords($transaction->InternalReference) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->CreatedAt)->format('d-m-Y / h:i:s A')}}
                                     </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                       {{-- {!! $all_transactions->links() !!} --}}

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
    {{-- @include('datetimepicker.datetimepicker') --}}
    {{-- <script type="text/javascript">
        $(function () {
            $('#datetimepicker12').datetimepicker({
                inline: true,
                sideBySide: true
            });
        });
     </script> --}}


@endsection


