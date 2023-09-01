@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">FAQs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQs Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">FAQs available</h4>
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
                            <h4 class="header-title mt-0 mb-1">FAQs</h4>
                        </div>
                    </div>
                    <a href="{{ route('faq.create') }}" class="btn btn-link">Add FAQs </a>
                    <br>

                    <div class="row">
                        <div class="col-xl-12">
                            @if(count($faqs))
                                <table class="table table-striped" style="width:100%" >
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Question</th>
                                        <th scope="col">Answer</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $faqs as $key=>$faq )
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{ $faq->question }}</td>
                                            <td>{{ $faq->answer }}</td>

                                            <td><a class="text-danger" href="{{ route('faq.remove',$faq->id) }}">Delete </a> |  <a href="{{ route('faq.edit',$faq->id) }}
                                                    ">Change </a> </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>
                            @else
                                <div class="card text-center">
                                    <div class="card-header">
                                        Ooopss
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Something... Happenned but don't worry
                                        </h5>

                                        <p class="card-text"> You have not added any FAQs
                                        </p>
                                        <a href="{{ route('faq.create') }}" class="btn btn-link">Add </a>
                                    </div>

                                </div>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
