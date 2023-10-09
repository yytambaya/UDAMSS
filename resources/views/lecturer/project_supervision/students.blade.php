@extends('layouts.app')

@php($supervisees = $data['supervisees'])
@php($supervisor = $data['supervisor'])

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-3">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-2">
                            <h3 class="">Supervisory Group </h3>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                            @if($supervisor['name']) <h4 class="text-monospace text-secondary">{{$supervisor['name']}} @endif</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-3">
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 mb-5">
                            <h3 class="">Supervisee List</h3>
                        </div>
                    </div>
                    <div class="table-responsive mb-4 mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Regno</th>
                                    <th>Name</th>
                                    <th>Approved Topic</th>
                                    <th>Progress</th>
                                    <th>Date</th>
                                    <th class="no-content">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($supervisees as $supervisee)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$supervisee['regno']}}</td>
                                    <td>{{$supervisee['name']}}</td>
                                    <td>{{ucwords( Str::limit($supervisee['topic'], 50, '...') )}}</td>
                                    <td>
                                        <div class="progress br-30">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-title"><span>50%</span></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$supervisee['date']}}</td>
                                    <td>
                                        <div class="dropdown custom-dropdown-icon">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-{{$supervisee['id']}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
                                            
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-{{$supervisee['id']}}" style="will-change: transform;">
                                                <a class="dropdown-item" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                 Profile</a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#instantDM-{{$supervisee['id']}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                                 Instant DM</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                                 WorkSpace</a>
                                            </div>
                                            <div class="modal fade" id="instantDM-{{$supervisee['id']}}" tabindex="-1" role="dialog" aria-labelledby="instantDM-{{$supervisee['id']}}-Label" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="instantDM-{{$supervisee['id']}}-Label">Send Direct Message</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="instant-dm-form" method="post" action="{{--route('')--}}">
                                                                @csrf
                                                                <div class="mb-4">
                                                                    <h6>Reciepient:
                                                                        <span class="text-monospace text-secondary">{{$supervisee['name']}} ({{$supervisee['regno']}})</span>
                                                                    </h6>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <form id="post-announcement" method="post" action="{{ route('postinteractionmessage.supervision.project')}}">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <input type="hidden" name="" value="">
                                                                            <textarea rows="5" name="content" class="form-control" placeholder="Compose a message..."></textarea>
                                                                        </div>
                                                                        <div class="form-group mb-0">
                                                                            <div class="n-chk">
                                                                                <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                                                                                    <input type="checkbox" name="label" class="new-control-input pr-3">
                                                                                    <span class="new-control-indicator"></span> Important?
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                            <button form="instant-dm-form" type="submit" class="btn btn-primary">Send</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        <p class="text-danger">No supervisees assigned!</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
