
@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Shipment</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shipment Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Add parcel</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                       
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                          	<form action="{{ route('parcel.submit') }}" method="POST" onSubmit="approveButton.disabled = true; return true;">

                            @csrf

                                           
										<div class="form-row">
                                                <div class="form-group col-4">
                                                <label for="role" class="" >Sender Location :</label>
                                                     <strong>{{ getRegionName($from) }}</strong>
                                                    <input type="hidden" name="from" value="{{ $from}}" />
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="role" class="">Receiver Location : </label>
                                                    <strong>{{ getRegionName($to) }}</strong>
                                                    <input  type="hidden" name="to" value="{{ $to}}" />
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="role" class="">Weight : </label>
                                                    <strong>{{ $weight}} (Kgs)</strong>
                                                    <input type="hidden" name="weight" value="{{ $weight}}" />
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-4">
                                                    <label for="role" class="">Shipment Type: </label> <strong>{{ $type}}</strong>
                                                    <input type="hidden" name="type" value="{{ $type}}" />
                                                </div>
                                                </break>
                                                <div class="form-group col-4">
                                                    <label for="role" class="">Quantity:  </label>
                                                   <strong>{{ $quantity}}</strong>
                                                    <input type="hidden" name="quantity" value="{{ $quantity}}" />
                                                </div> <br><br>
                                                @if(auth()->check() && auth()->user()->type == 'super-admin' || auth()->check() && auth()->user()->type == 'Admin' || auth()->check() && auth()->user()->type == 'Collection Officer' || auth()->check() && auth()->user()->type == 'Sorting Officer' )

                                                <div class="form-group col-4">
                                                    <label for="role" class="">Price: </label>
                                                    <strong> {{$price}}</strong>
                                                    <input type="hidden" name="price" value="{{$price}}"/>
                                                </div>
                                                @else
                                                @endif
                                            </div>
                                           

                                       


                                            <div class="form-group row mb-3">
                                                <label for="role" class="col-3 col-form-label">Sender Name </label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="" placeholder="Enter Sender Name." required name="sender" />
                                                </div>
                                            </div>
						
                                            <div class="form-group row mb-3">
                                                <label for="role" class="col-3 col-form-label">Sender Phone </label>
                                                <div class="col-9">
                                                    <input type="number" class="form-control" id="" placeholder="Enter Sender Tel." required name="sender_phone" />
                                                </div>
                                            </div>
											<div class="form-group row mb-3">
                                                <label for="role" class="col-3 col-form-label">Sender ID </label>
                                                <div class="col-9">
                                                    <input type="number" class="form-control" id="" placeholder="Enter Sender ID." required name="sender_id" />
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="role" class="col-3 col-form-label">Receiver Name </label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="" placeholder="Enter Receiver Name." required name="receiver" />
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label for="role" class="col-3 col-form-label">Receiver Tel. </label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="" placeholder="Enter Receiver Tel." required name="receiver_phone" />
                                                </div>
                                            </div>
											 <div class="form-group row mb-3">
                                                <label for="role" class="col-3 col-form-label">Receiver ID. </label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="" placeholder="Enter Receiver ID." required name="receiver_id" />
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="role" class="col-3 col-form-label">Select Payment Type </label>
                                                <div class="col-9">
                                                <select id="paymentMethod" class="form-group custom-select" name="paymentMethod">
                                                    <option value="">Select a payment method</option>
                                                    <option value="mpesa">Mpesa</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="credit">Credit</option>
                                                </select>
                                                </div>  
                                                
                                               
                                            </div>
                                            <div id="mpesaField" style="display: none;">
                                                        <label class="col-3 col-form-label" for="mpesaCode" >Mpesa Code:</label>  
                                                        <input type="text" class="form-control" id="mpesaCode" name="mpesaCode" />                                                    
                                                </div>
                                                <br><br>

                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="submit" class="btn btn-primary mb-2" name="approveButton">Add Parcel<i class="uil uil-location-arrow"></i></button>
                        </form>
						    <script>
                            $(document).ready(function() {
                                $('#paymentMethod').change(function() {
                                    var selectedOption = $(this).val();

                                    if (selectedOption === 'mpesa') {
                                        $('#mpesaField').show();
                                    } else {
                                        $('#mpesaField').hide();
                                    }
                                });
                            });
                        </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
