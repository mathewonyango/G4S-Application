<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>

    <title>@yield('title',''){{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{config('app.name')}}">
    <meta name="author" content="{{config('app.name')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/G4S.ico') }}">

    <!-- App css -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>

    <style>
        .danger {
            color: red;
        }
    </style>
</head>

<body>
<div class="account-pages my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-md-inline-block">
                                <div class="auth-page-sidebar">
                                    <div class="auth-user-testimonial">
                                        <img src="#" alt="">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-5">
                                <div class="mx-auto mb-5">
                                    <h2><strong>Admin Module</strong></h2>

                                </div>

                                @include('partials.alerts')

                                <form action="{{ route('post-login') }}" method="post" class="authentication-form">
                                    @csrf

                                    <div class="form-group mt-4">
                                        <label class="form-control-label">Employee Number</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class='uil uil-user-circle'></i>
                                                </span>
                                            </div>
                                            <input type="employee_number"
                                                   class="form-control @if($errors->has('employee_number')) is-invalid @endif"
                                                   id="employee_number"
                                                   placeholder="Enter your employee number" name="employee_number"/>

                                            @if($errors->has('employee_number'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('employee_number') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <label class="form-control-label">Password</label>
                                        <a href="#" hidden
                                           class="float-right text-muted text-unline-dashed ml-1">Forgot your
                                            password?</a>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="uil uil-lock-alt"></i>
                                                </span>
                                            </div>
                                            <input type="password"
                                                   class="form-control @if($errors->has('password')) is-invalid @endif"
                                                   id="password"
                                                   placeholder="Enter your password" name="password"/>

                                            @if($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-info btn-block" style="background:#004785 ; cursor:pointer" type="submit"> Log In
                                        </button>
                                    </div>
                                </form>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<p class="text-center">Powered By: <a href="https://www.aogroup.co.za/">AO Technology Group</a></p>
</body>

</html>
