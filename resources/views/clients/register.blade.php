
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>AO</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/images/AO_logo.PNG') }}" rel="icon">
    <link href="{{ asset('landing/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="{{asset('assets/css/external.css')}}" rel="stylesheet">

</head>
<body>

<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="{{asset('assets/images/im-remove.png')}}" width="60" height="65" alt=""/>
            <h3>Welcome</h3>
            <p>This is AO Logistics</p>
        </div>
        <br/>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Client</a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @include('flash::message')
                    <h3 class="register-heading">Client Self Registration</h3>
                    <form action="{{route('self-reg')}}" method="POST">
                        @csrf
                        <div class="row register-form">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Full Names *" value="" name="fullname"/>
                                </div>
                                <div class="form-group">
                                    <input type="phone" class="form-control" placeholder="Phone Number *" value="" name="phone_number" />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email Address *" value="" name="email" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btnRegister"  value="Register"/>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
