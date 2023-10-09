@extends('layouts.app')

@php($lecturers = $data['lecturers'])
@php($supervisory_groups = $data['supervisory_groups'])
@php($students = $data['students'])
@php($opened_submission = $data['opened_submission'])
@php($session = $data['session'])
@php($due_date = $data['due_date'])

@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-sm-12 col-12 layout-spacing">
                <div class="row mb-4">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-3  layout-spacing">
                        <h2 class="">Project Activity Setup - {{$session}}</h2>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <fieldset class="form-group border-round p-3 w-auto">
                                <legend class="badge badge-dark text-left w-auto">Topic Submissions</legend>
                                @if(Session::has('error'))
                                    <span class="invalid-feedback d-flex mb-3" role="alert">
                                        <strong>{{Session::get('error')}}</strong>
                                    </span>
                                @elseif(Session::has('warning'))
                                    <span class="invalid-feedback d-flex mb-3" role="alert">
                                        <strong>{{Session::get('warning')}}</strong>
                                    </span>
                                @endif
                                <div class="form-row">
                                    <div class="col-12 my-4">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="py-2 pr-3">
                                                        <h6 class="font-weight-bolder text-monospace">Submission Status:</h6>
                                                    </td class="py-2">
                                                    <td>@if($opened_submission)
                                                        <h6 class="font-weight-bolder text-monospace badge badge-success">Opened</h6>
                                                        @else
                                                        <h6 class="font-weight-bolder text-monospace badge badge-danger">Closed</h6>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @if($opened_submission)
                                                <tr>
                                                    <td class="py-2 pr-3">
                                                        <h6 class="font-weight-bolder text-monospace">Submission Due:</h6>
                                                    </td class="py-2">
                                                    <td>
                                                        <h6 class="font-weight-bolder text-monospace">{{$due_date}}</h6>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>                                                                        
                                </div>  
                                <div class="form-row mb-4">
                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#openSubmission" @disabled($opened_submission)>Open Submission</button>
                                        <div class="modal fade" id="openSubmission" tabindex="-1" role="dialog" aria-labelledby="openSubmissionLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="openSubmissionLabel">Open Submission</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="submission-deadline-form" method="post" action="{{route('opensubmission.coordination.project')}}">
                                                            @csrf
                                                            <div class="form-row mb-2">
                                                                <div class="form-group col-lg-12 col-md-12 col-12">
                                                                    <label for="deadline_date">Deadline Date</label>
                                                                    <input type="date" class="form-control" id="deadline_date" name="deadline_date" min="0" value="{{old('deadline_date')}}">
                                                                </div>
                                                                @error('deadline_date')
                                                                    <p class="text text-danger">{{$message}}</p>
                                                                @enderror
                                                                <div class="form-group col-lg-12 col-md-12 col-12">
                                                                    <label for="deadline_time">Deadline Time</label>
                                                                    <input type="time" class="form-control" id="deadline_time" name="deadline_time" min="0" value="{{old('deadline_time')}}">
                                                                </div>
                                                                @error('deadline_time')
                                                                    <p class="text text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                        <button form="submission-deadline-form" type="submit" class="btn btn-primary">Open</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#confirmCloseSubmission" @disabled(!$opened_submission)>Close Submission</button>
                                        <div class="modal fade" id="confirmCloseSubmission" tabindex="-1" role="dialog" aria-labelledby="confirmCloseSubmissionLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmCloseSubmissionLabel">Close Submission</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2 class="text-center">Are You Sure?</h2>
                                                        <h5 class="text-center">You Want To Close This Submission?</h5>
                                                        <form id="close-submission-form" method="post" action="{{route('closesubmission.coordination.project')}}">@csrf</form>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                        <button form="close-submission-form" type="submit" class="btn btn-warning">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-3">
                                <h4 class="text-center mb-5">Supervisory Groups</h4>
                            </div>
                            <fieldset class="form-group border-round p-3 w-auto">
                                <legend class="badge badge-secondary text-left w-auto">Supervisory Group List</legend>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-spacing">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-4">
                                            <thead>
                                                <tr>
                                                    <th>Group #</th>
                                                    <th>Supervisor</th>
                                                    <th>Limit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($supervisory_groups as $supervisory_group)
                                                <tr>
                                                    <td>{{$supervisory_group['sgid']}}</td>
                                                    <td>{{$supervisory_group['supervisor']}}</td>
                                                    <td>{{$supervisory_group['limit']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group border-round p-3 w-auto">
                                <legend class="badge badge-secondary text-left w-auto">Supervisory Group Creation</legend>
                                @error('supervisor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#addGroup">Add Group</button>
                                <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="addGroupLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addGroupLabel">Add New Supervision Group</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="add-group-form" method="post" action="{{route('create.supervisory.group')}}">
                                                    @csrf
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-lg-12 col-md-12 col-12">
                                                            <label for="supervisor_id">Group Supervisor</label>
                                                            <select class="selectpicker" data-live-search="true" data-width="100%"  id="supervisor_id" name="supervisor_id">
                                                                <option value="">Choose...</option>
                                                                @foreach($lecturers as $lecturer)
                                                                <option value="{{$lecturer->id}}">{{$lecturer->getFormattedName()}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-12 col-12">
                                                            <label for="supervision_limit">Students Limit</label>
                                                            <input type="number" class="form-control" id="supervision_limit" name="supervision_limit" value="8" placeholder="Students' Limit" min="0">
                                                        </div>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                <button form="add-group-form" type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-3">
                                <h4 class="text-center mb-5">Supervisory Assignment</h4>
                            </div>
                            @if(Session::has('max_supervision_limit'))
                                <span class="invalid-feedback d-flex mb-3 justify-content-center" role="alert">
                                    <strong>{{Session::get('max_supervision_limit')}}</strong>
                                </span>
                            @endif
                            <form id="assgin-supervisee" method="post" action="{{route('assign.supervisee')}}">
                                <fieldset class="form-group border-round p-3 w-auto">
                                    <legend class="badge badge-success text-left w-auto">New Student Assignment</legend>
                                    <div class="">
                                        @csrf
                                        <div class="form-row mb-4">
                                            <div class="form-group col-lg-6 col-md-12 col-12">
                                                <label for="supervisory_group_id">Group Supervisor</label>
                                                <select id="supervisory_group_id" class="form-control" name="supervisory_group_id">
                                                    <option value="-">Choose...</option>
                                                    @foreach($supervisory_groups as $supervisory_group)
                                                    <option value="{{$supervisory_group['sgid']}}" @selected(old('sgid') == $supervisory_group['sgid'])>{{$supervisory_group['supervisor']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12 col-12">
                                                <label for="student_id">Student</label>
                                                <select class="selectpicker" data-live-search="true" data-width="100%" id="student_id" name="student_id">
                                                    <option value="-">Choose...</option>
                                                    @foreach($students as $student)
                                                        <option value="{{$student->id}}" @selected(old('student_id') == $student->id)>{{$student->student->getCapRegno()}} - {{ $student->getFormattedName() }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12 col-12">
                                                <label for="topic_1">Project Topic 1</label>
                                                <textarea rows="3" class="form-control" id="topic_1" name="topic_1">{{old('topic_1')}}</textarea>
                                                @error('topic_1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12 col-12">
                                                <label for="topic_2">Project Topic 2</label>
                                                <textarea rows="3" class="form-control" id="topic_2" name="topic_2">{{old('topic_2')}}</textarea>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12 col-12">
                                                <label for="topic_3">Project Topic 3</label>
                                                <textarea rows="3" class="form-control" id="topic_3" name="topic_3">{{old('topic_3')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-lg-6 col-md-12 col-12">
                                                <button form="assgin-supervisee" type="submit" class="btn btn-primary">Assign</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            <form id="reassgin-supervisee" method="post" action="{{route('reassign.supervisee')}}">
                                <fieldset class="form-group border-round p-3 w-auto">
                                    <legend class="badge badge-success text-left w-auto">Student Reassignment</legend>
                                    <div class="">
                                        @csrf
                                        <div class="form-row mb-4">
                                            <div class="form-group col-lg-6 col-md-12 col-12">
                                                <label for="current_supervisory_group_id">Current Group Supervisor</label>
                                                <select id="current_supervisory_group_id" class="form-control" name="current_supervisory_group_id">
                                                    <option value="">Choose...</option>
                                                    @foreach($supervisory_groups as $supervisory_group)
                                                    <option value="{{$supervisory_group['sgid']}}">{{$supervisory_group['supervisor']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12 col-12">
                                                <label for="reassign_student_id">Student</label>
                                                <select class="form-control" id="reassign_student_id" name="student_id">
                                                    <option value="">Choose...</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12 col-12">
                                                <label for="new_supervisory_group_id">New Group Supervisor</label>
                                                <select id="new_supervisory_group_id" class="form-control" name="new_supervisory_group_id">
                                                    <option value="">Choose...</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-lg-6 col-md-12 col-12">
                                                <button form="reassgin-supervisee" type="submit" class="btn btn-primary">Re-assign</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
