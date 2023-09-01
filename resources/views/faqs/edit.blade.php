@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">FAQS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQs Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Update FAQ</h4>
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
                            <h4 class="header-title mt-0 mb-1">Update Faq</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('faq.post') }}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="firstName3" class="col-3 col-form-label">Question</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="firstName3" placeholder="Faq Question"
                                               required value="{{ old('question', $faq->question) }}" name="question">
                                    </div>
                                </div>


                                <div class="form-group row mb-3">
                                    <label for="lastName3" class="col-3 col-form-label">Answer</label>
                                    <div class="col-9">
                                        <textarea type="text" class="form-control" id="lastName3" placeholder="Type the answer"
                                                  required value="{{ old('answer', $faq->answer) }}" name="answer" required></textarea>
                                    </div>
                                </div>


                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-location-arrow"></i> Submit Edit</button>
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
