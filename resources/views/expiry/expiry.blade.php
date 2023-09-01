@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Session</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Session Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Session Configs</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">Set session below</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="
                       {{-- //     {{ route('location.create') }} --}}
                            " method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="locationName" class="col-3 col-form-label">System session time (in minutes)</label>
                                    <div class="col-9">
                                        <input type="number" class="form-control" id="group account number" placeholder="150"
                                               required value="{{ old('session') }}" name="session">
                                    </div>
                                </div>


                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-location-arrow"></i>Submit System session time</button>
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
