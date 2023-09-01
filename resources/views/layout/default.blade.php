<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body>

<div id="wrapper">
    @include('partials.topnav')
    @include('partials.sidebar')

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                @include('partials.alerts')

                @yield('breadcrumb')
                @yield('content')
            </div>
        </div>

        @include('partials.footer')
    </div>
</div>

@include('partials.footer-script')
</body>

</html>

