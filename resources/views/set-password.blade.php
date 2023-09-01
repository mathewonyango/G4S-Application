<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>

    <title>@yield('title',''){{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/ao_favicon.png') }}">

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
                            <div class="col-md-6 p-5">
                                <div class="mx-auto mb-5">
                                    <h2><strong>{{ config('app.name') }} - Portal</strong></h2>
                                </div>

                                @include('partials.alerts')

                                <form action="{{ route('set-password') }}" method="post" class="authentication-form">
                                    @csrf

                                    <input type="hidden" name="code" value="{{$code}}">
                                    <input type="hidden" name="ref" value="{{$code_id}}">

                                    <div class="form-group">
                                        <label class="form-control-label">Set Password</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="uil uil-unlock"></i>
                                                </span>
                                            </div>
                                            <input minlength="6" name="password" required class="form-control" placeholder="Password" type="password">
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Submit
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-6 d-none d-md-inline-block">
                                <div class="auth-page-sidebar">
                                    <div class="auth-user-testimonial">
                                        <img src="#" alt="">
                                        <p>- Admin User</p>
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
</body>

</html>
