@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-sm-8 col-xl-6">
            <h4 class="mb-1 mt-0">
                Agent Data
{{--                <div class="badge badge-success font-size-13 font-weight-normal">Completed</div>--}}
{{--                <div class="badge badge-soft-primary font-size-13 font-weight-normal">Web Design</div>--}}
            </h4>
        </div>
        <div class="col-sm-4 col-xl-6 text-sm-right">
            <div class="btn-group ml-2 d-none d-sm-inline-block">
{{--                @can('view_user')--}}
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-soft-primary float-right"
                       rel="tooltip" data-placement="top" title="Back to Users">
                        <i class="uil uil-arrow-left"> Back to Users</i>
                    </a>
{{--                @endcan--}}
            </div>
{{--            <div class="btn-group d-none d-sm-inline-block">--}}
{{--                <button type="button" class="btn btn-soft-danger btn-sm"><i--}}
{{--                        class="uil uil-trash-alt mr-1"></i>Download</button>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body p-0">
                    <h6 class="card-title boarder-bottom p-3 mb-0 header-title">On-boarding Overview</h6>
                    <div class="row py-1">
                        <div class="col-xl-3 col-sm-6">
                            <!-- stat 1 -->
                            <div class="media p-3">
                                <i data-feather="briefcase" class="align-self-center icon-dual icon-lg mr-4"></i>
                                <div class="media-body">
                                    <h4 class="mt-0 mb-0">210</h4>
                                    <span class="text-muted font-size-13">Deposits</span>
                                    <span><small>(Per Day)</small></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <!-- stat 2 -->
                            <div class="media p-3">
                                <i data-feather="credit-card" class="align-self-center icon-dual icon-lg mr-4"></i>
                                <div class="media-body">
                                    <h4 class="mt-0 mb-0">121</h4>
                                    <span class="text-muted">Withdrawals</span>
                                    <span><small>(Per Day)</small></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <!-- stat 3 -->
                            <div class="media p-3">
                                <i data-feather="check-square" class="align-self-center icon-dual icon-lg mr-4"></i>
                                <div class="media-body">
                                    <h6 class=" text-uppercase text-success mt-0 mb-0">Checker Approval</h6>
                                    <span class="h2 font-weight-bold mb-o">
                                        <button data-toggle="modal" data-target="#approvalModal"
                                                class="btn btn-outline-primary btn-sm mt-4 mb-3"> Click here to approve</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <!-- stat 3 -->
                            <div class="media p-3">
                                <i data-feather="x-circle" class="align-self-center icon-dual icon-lg mr-4"></i>
                                <div class="media-body">
                                    <h6 class=" text-uppercase text-success mt-0 mb-0">Checker Decline</h6>
                                    <span class="h2 font-weight-bold mb-o">
                                        <button data-toggle="modal" data-target="#approvalModal"
                                                class="btn btn-outline-danger btn-sm mt-4 mb-3"> Click here to decline</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--        @if(($upload->stage!='checker-approval') || ($upload->stage!='transmission-approval'))--}}
                    <div class="col-lg-6">

                        <strong>Timeline</strong>
                        <ul>
                            {{--                    @foreach($upload->events as $event)--}}
                            <li>
                                <small>
                                    {{--                                {{$event->title}} - {{$event->creator->name}}--}}
                                    {{--                                - {{ carbon($event->created_at)->format('M j, Y g:i A')}}--}}

                                    {{--                                @if($event->comment)--}}
                                    {{--                                    <span class="d-block">Comment: {{$event->comment}}</span>--}}
                                    {{--                                @endif--}}

                                </small>
                            </li>
                            {{--                    @endforeach--}}
                        </ul>
                    </div>
                    {{--        @endif--}}

                </div>
            </div>
        </div>
    </div>

    <div class="row">
    </div>
@endsection
