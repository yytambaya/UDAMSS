@extends('layouts.app')

@php($supervisory_groups = $data['supervisory_groups'])
@php($submissions = $data['submissions'])

@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-sm-12 col-12 layout-spacing">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-3  layout-spacing">
                    <h2 class="">Project Information Submissions</h2>
                </div>
                <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-3">
                            <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 mb-5">
                                <h3 class="">Project Topics Submissions</h3>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">    
                                <div class="row">    
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                        <form method="post" action="{{route('approvegroupsubmissions.coordination.project')}}">
                                            @csrf
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary" type="submit">Approve By Supervisor</button>
                                                </div>
                                                <select class="form-control form-control-sm" name="supervisory_group_id" required>
                                                    <option value="">--Select supervisor--</option>
                                                    @foreach($supervisory_groups as $supervisory_group)
                                                    <option value="{{$supervisory_group['sgid']}}">{{$supervisory_group['supervisor']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-center">
                                        <div class="">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmApprove">Approve All</button>
                                            <div class="modal fade" id="confirmApprove" tabindex="-1" role="dialog" aria-labelledby="confirmApproveLabel" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmApproveLabel">Approve Submissions</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="">
                                                                <h3 class="text-center">Are You Sure?</h3>
                                                                <p class="text-center">You want to approve all submissions?</p>
                                                            </div>
                                                            <form id="approve-all-submissions-form" method="post" action="{{route('approveallsubmissions.coordination.project')}}">
                                                                @csrf
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                            <button form="approve-all-submissions-form" type="submit" class="btn btn-primary">Approve</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student</th>
                                        <th>Topic</th>
                                        <th>Supervisor</th>
                                        <th>Date</th>
                                        <th class="no-content">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($submissions as $submission)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$submission['regno']}} - {{$submission['name']}}</td>
                                        <td>{{Str::limit($submission['topic'], 50, '...')}}</td>
                                        <td>{{$submission['supervisor']}}</td>
                                        <td>{{$submission['date']}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmApproveSupervisee-{{$submission['id']}}">Approve</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="confirmApproveSupervisee-{{$submission['id']}}" tabindex="-1" role="dialog" aria-labelledby="confirmApproveSupervisee-{{$submission['id']}}-Label" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmApproveSupervisee-{{$submission['id']}}-Label">Approve Submissions</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="">
                                                        <h3 class="text-center">Are You Sure?</h3>
                                                        <p class="text-center">You want to approve this submission from:</p>
                                                        <h5 class="text-center">{{$submission['name']}} ({{$submission['regno']}})</h5>
                                                    </div>
                                                    <form id="approve-submission-{{$submission['id']}}-form" method="post" action="{{route('approvesubmission.coordination.project')}}">
                                                        @csrf
                                                        <input type="hidden" name="supervisee_id" value="{{$submission['id']}}">
                                                    </form>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    <button form="approve-submission-{{$submission['id']}}-form" type="submit" class="btn btn-primary">Approve</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr><td colspan="4">No new submissions</td></tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Student</th>
                                        <th>Topic</th>
                                        <th>Supervisor</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
