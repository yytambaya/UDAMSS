@extends('layouts.app')
{{--
    @php($supervisory_groups = [])
    @php($submissions = [])
    
--}}

@php($supervisory_groups = $data['supervisory_groups'])
@php($opened_submission = $data['opened_submission'])
@php($supervisee = $data['supervisee'])
@php($supervisor = $data['supervisor'])
@php($submission = $data['submission'])
@php($session = $data['session'])
@php($due_date = $data['due_date'])


@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-sm-12 col-12 layout-spacing">
                <div class="row mb-4">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-3">
                        <h2 class="text-primary">Project Activity - {{$session}}</h2>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-4">
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-6">
                                <fieldset class="form-group border-round p-3 w-auto">
                                    <legend class="badge badge-dark text-left w-auto">Student</legend>
                                    <div class="">
                                        <h4 class="text-monospace text-secondary">{{$supervisee['name']}}</h4>
                                        <h4 class="text-monospace text-secondary">({{$supervisee['regno']}})</h4>
                                    </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-3">
                                <h3 class="text-center mb-5">Project Information Submission</h3>
                            </div>
                            <div class="mb-5">
                                <fieldset class="form-group border-round p-3 w-auto">
                                    <legend class="badge badge-success text-left w-auto">Topic Submission</legend>
                                    @if(Session::has('error'))
                                        <span class="invalid-feedback d-flex mb-3" role="alert">
                                            <strong>{{Session::get('error')}}</strong>
                                        </span>
                                    @elseif(Session::has('warning'))
                                        <span class="invalid-feedback d-flex mb-3" role="alert">
                                            <strong>{{Session::get('warning')}}</strong>
                                        </span>
                                    @endif
                                    <div class="">
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
                                </fieldset>
                            </div>
                            <div class="mb-3">
                                <fieldset class="form-group border-round p-3 w-auto">
                                    <legend class="badge badge-dark text-left w-auto">Submit Information</legend>
                                    @if($submission['hasTopic'])
                                    <div class="">
                                            <p class="pl-3 text-success font-weight-bold">You have made a submission</p>
                                            <div class="col-12 mb-5 mt-4">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td class="pb-3" width="25%">
                                                                <h6 class="font-weight-bolder text-monospace text-secondary">Preffered Supervisor:</h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="pl-3 pb-3 text-monospace text-justify">{{$supervisor['name']}}</h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-3">
                                                                <h6 class="font-weight-bolder text-monospace text-secondary">Preffered Topic 1:</h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="pl-3 pb-3 text-monospace text-justify">{{ucfirst($submission['topic1'])}} @if($submission['approvedTopic'] == 1) <span class="text-success">(Approved)</span> @endif</h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-3">
                                                                <h6 class="font-weight-bolder text-monospace text-secondary">Preffered Topic 2:</h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="pl-3 pb-3 text-monospace text-justify">{{ucfirst($submission['topic2'])}} @if($submission['approvedTopic'] == 2) <span class="text-success">(Approved)</span> @endif</h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-3">
                                                                <h6 class="font-weight-bolder text-monospace text-secondary">Preffered Topic 2:</h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="pl-3 pb-3 text-monospace text-justify">{{ucfirst($submission['topic3'])}} @if($submission['approvedTopic'] == 3) <span class="text-success">(Approved)</span> @endif</h6>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>  
                                            @if($opened_submission && !$supervisee['isApprovedSubmission'])
                                            <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#confirmUpdateSubmission">Update Submission</button>
                                            <div class="modal fade" id="confirmUpdateSubmission" tabindex="-1" role="dialog" aria-labelledby="confirmUpdateSubmissionLabel" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmUpdateSubmissionLabel">Update Submission</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="update-submission-form" method="post" action="{{route('update.student.submission.project')}}">
                                                                @csrf
                                                                <div class="form-row mb-0">
                                                                    <div class="form-group col-12">
                                                                        <label for="supervisory_group_id">Supervisor</label>
                                                                        <select id="supervisory_group_id" class="selectpicker" data-live-search="true" data-width="100%" name="supervisory_group_id">
                                                                            <option value="-">Choose...</option>
                                                                            @foreach($supervisory_groups as $supervisory_group)
                                                                            <option value="{{$supervisory_group['sgid']}}" @selected(old('supervisory_group_id') == $supervisory_group['sgid'] || $supervisory_group['sgid'] == $supervisor['sgid']) @disabled($supervisory_group['isFull'])>{{$supervisory_group['supervisor']}} @if($supervisory_group['isFull']) (FULL) @endif</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-12">
                                                                        <label for="topic_1">Project Topic 1</label>
                                                                        <textarea rows="2" class="form-control" id="topic_1" name="topic_1">{{old('topic_1', ucfirst($submission['topic1']))}}</textarea>
                                                                        @error('topic_1')
                                                                            <span class="invalid-feedback d-flex" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-12">
                                                                        <label for="topic_2">Project Topic 2</label>
                                                                        <textarea rows="2" class="form-control" id="topic_2" name="topic_2">{{old('topic_2', ucfirst($submission['topic2']))}}</textarea>
                                                                        @error('topic_2')
                                                                        <span class="invalid-feedback d-flex" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-12 mb-0">
                                                                        <label for="topic_3">Project Topic 3</label>
                                                                        <textarea rows="2" class="form-control" id="topic_3" name="topic_3">{{old('topic_3', ucfirst($submission['topic3']))}}</textarea>
                                                                        @error('topic_3')
                                                                        <span class="invalid-feedback d-flex" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                            <button form="update-submission-form" type="submit" class="btn btn-warning">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif                                                              
                                        </div> 
                                        @else
                                        @if(Session::has('error'))
                                            <span class="invalid-feedback d-flex mb-3 justify-content-center" role="alert">
                                                <strong>{{Session::get('error')}}</strong>
                                            </span>
                                            @else
                                            <p class="text-danger font-weight-bold">You have not made a submission</p>
                                            @endif
                                            <div class="mt-4">
                                                <form method="post" action="{{route('submit.student.submission.project')}}">
                                                    @csrf
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-lg-6 col-md-12 col-12">
                                                            <label for="supervisory_group_id">Supervisor</label>
                                                            <select id="supervisory_group_id" class="selectpicker" data-live-search="true" data-width="100%" name="supervisory_group_id">
                                                                <option value="">Choose...</option>
                                                                @foreach($supervisory_groups as $supervisory_group)
                                                                <option value="{{$supervisory_group['sgid']}}" @selected(old('supervisory_group_id') == $supervisory_group['sgid']) @disabled($supervisory_group['isFull'])>{{$supervisory_group['supervisor']}} @if($supervisory_group['isFull']) (FULL) @endif</option>
                                                                @endforeach
                                                            </select>
                                                            @error('supervisory_group_id')
                                                                <span class="invalid-feedback d-flex" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-lg-6 col-md-12 col-12">
                                                            <label for="topic_1">Project Topic 1</label>
                                                            <textarea rows="3" class="form-control" id="topic_1" name="topic_1">{{old('topic_1')}}</textarea>
                                                            @error('topic_1')
                                                                <span class="invalid-feedback d-flex" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-lg-6 col-md-12 col-12">
                                                            <label for="topic_2">Project Topic 2</label>
                                                            <textarea rows="3" class="form-control" id="topic_2" name="topic_2">{{old('topic_2')}}</textarea>
                                                            @error('topic_2')
                                                                <span class="invalid-feedback d-flex" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-lg-6 col-md-12 col-12">
                                                            <label for="topic_3">Project Topic 3</label>
                                                            <textarea rows="3" class="form-control" id="topic_3" name="topic_3">{{old('topic_3')}}</textarea>
                                                            @error('topic_3')
                                                                <span class="invalid-feedback d-flex" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-6 col-md-12 col-12">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            @endif
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

