@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Payments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Making Payments</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <br>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="container py-7">
                                <!-- For demo purpose -->
                                <div class="row mb-4">
                                    <div class="col-lg-12 mx-auto text-center">
                                        <h5 class="display-12">Our Accepted Payment Methods</h5>
                                    </div>
                                </div> <!-- End -->
                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card ">
                                            <div class="card-header">
                                                <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                                                    <!-- Credit card form tabs -->
                                                    <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                                        <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                                                        <li class="nav-item"> <a data-toggle="pill" href="#net-banking" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Mobile Money </a> </li>
                                                    </ul>
                                                </div> <!-- End -->
                                                <!-- Credit card form content -->
                                                <div class="tab-content">
                                                    <!-- credit card info-->
                                                    <div id="credit-card" class="tab-pane fade show active pt-3">
                                                        <form role="form" onsubmit="event.preventDefault()">
                                                            <div class="form-group"> <label for="username">
                                                                    <h6>Card Owner</h6>
                                                                </label> <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                                            <div class="form-group"> <label for="cardNumber">
                                                                    <h6>Card number</h6>
                                                                </label>
                                                                <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                                                    <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                                                        <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                                            <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                                        </label> <input type="text" required class="form-control"> </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer"> <button type="button" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
                                                        </form>
                                                    </div>
                                                </div> <!-- End -->

                                                <!-- Mobile transfer info -->
                                                <div id="net-banking" class="tab-pane fade pt-3">
                                                    <div class="form-group "> <label for="Select Your Bank">
                                                            <h6>Select your Telecommunication Company</h6>
                                                        </label> <select class="form-control" id="ccmonth">
                                                            <option value="" selected disabled>--Please Select Operator--</option>
                                                            <option>Safaricom -MPESA</option>
                                                            <option>Airtel - Money</option>
                                                        </select> </div>
                                                    <div class="form-group">
                                                        <p> <button type="button" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i> Proceed Payment</button> </p>
                                                    </div>
                                                    <p class="text-muted"> </p>
                                                </div> <!-- End -->
                                                <!-- End -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection


