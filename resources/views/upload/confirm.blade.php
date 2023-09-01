
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
						  <form action="{{ route('bulk.submit') }}" method="post">
                                @csrf
                                <div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Parcel ID</label>
                                    <div class="col-9">
                                    <h6><strong>{{ $parcel_id }} </strong></h6>
                                    <input type="hidden" name="parcel_id" value="{{ $parcel_id }}"/>           
                                    </div>
                                </div>
                                @if(auth()->check() && auth()->user()->type == 'super-admin')

                                <div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Price</label>
                                    <div class="col-9">
                                    <strong>{{ $price }} </strong>
                                    <input type="hidden" name="price" value="{{ $price }}"/>           
                                    </div>
                                </div>
                                @else
                                @endif


                                <div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Sender Location</label>
                                    <div class="col-9">
                                    <strong>{{ $to }} </strong>
                                    <input type="hidden" name="to" value="{{$get_to_id  }}"/>           
                                    </div>
                                </div>

                                <div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Reciever Location</label>
                                    <div class="col-9">
                                    <strong>{{ $from }} </strong>
                                    <input type="hidden" name="from" value="{{ $from_to_id }}"/>           
                                    </div>
                                </div>

                                <div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Quantity</label>
                                    <div class="col-9">
                                    <strong>{{ $quantity }} </strong>
                                    <input type="hidden" name="quantity" value="{{ $quantity }}"/>           
                                    </div>
                                </div>

                                <div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Reciever Phone</label>
                                    <div class="col-9">
                                    <strong>{{ $reciever_phone }} </strong>
                                    <input type="hidden" name="receiver_phone" value="{{ $reciever_phone }}"/>           
                                    </div>
                                </div>

                                <div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Sender Phone</label>
                                    <div class="col-9">
                                    <strong>{{ $sender_phone }} </strong>
                                    <input type="hidden" name="sender_phone" value="{{ $sender_phone }}"/>           
                                    </div>
                                </div>

                                <div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Sender Name</label>
                                    <div class="col-9">
                                    <strong>{{ $sender }} </strong>
                                    <input type="hidden" name="sender" value="{{ $sender }}"/>           
                                    </div>
                                </div>

                                <div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Reciever Name</label>
                                    <div class="col-9">
                                    <strong>{{ $reciever }} </strong>
                                    <input type="hidden" name="receiver" value="{{ $reciever }}"/>           
                                    </div>
                                </div>
								
								<div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Sender ID Number</label>
                                    <div class="col-9">
                                    <strong>{{ $sender_id }} </strong>
                                    <input type="hidden" name="sender_id" value="{{ $sender_id }}"/>           
                                    </div>
                                </div>

                                <div class="form-group row mb-1">
                                    <label for="weight" class="col-2 col-form-label">Receiver ID</label>
                                    <div class="col-9">
                                    <strong>{{ $receiver_id }} </strong>
                                    <input type="hidden" name="receiver_id" value="{{ $receiver_id }}"/>           
                                    </div>
                                </div>
								
								 <input type="hidden" name="parcel_id" value="{{ $parcel_id }}"/>    
								<input type="hidden" name="id" value="{{ $id }}"/>								 

          
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-eye"></i>
                                        Confirm and Update</button>
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
