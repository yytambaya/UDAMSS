@extends('layouts.app')

@php($students = $data['students'])

@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-sm-12 col-12 layout-spacing">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-3  layout-spacing">
                    <h2 class="">Students</h2>
                </div>
                <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-3">
                            <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 mb-5">
                                <h3 class="">Students List</h3>
                            </div>
                        </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Registration Number</th>
                                        <th>Level</th>
                                        <th>Role</th>
                                        <th class="no-content">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($students as $student)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$student->getFormattedName()}}</td>
                                        <td>{{$student->student->getCapRegno()}}</td>
                                        <td>{{$student->student->level}}00</td>
                                        <td>{{ucfirst($student->role)}}</td>
                                        <td>
                                            <div class="">
                                                <form id="view-form-{{encode($student->id)}}" method="post" action="{{route('get.profile')}}">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{encode($student->id)}}">
                                                    <button id="view-form-{{encode($student->id)}}" type="submit" class="btn btn-primary">View</button>
                                                </form>
                                                <a class="btn btn-secondary m-1" href="javascript:void(0);" data-toggle="modal" data-target="#instantDM-{{($student->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="instantDM-{{($student->id)}}" tabindex="-1" role="dialog" aria-labelledby="instantDM-{{($student->id)}}-Label" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="instantDM-{{($student->id)}}-Label">Send Direct Message</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="instant-dm-form-{{encode($student->id)}}" method="post" action="{{--route('')--}}">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <h6>Reciepient:
                                                                <span class="text-monospace text-secondary">{{$student->getFormattedName()}} ({{$student->student->getCapRegno()}})</span>
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
                                                                            <span class="new-control-indicator"></span> <span class="ml-3">Important?</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    <button form="instant-dm-form-{{encode($student->id)}}" type="submit" class="btn btn-primary">Send</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr><td colspan="4">No staff</td></tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Registration Number</th>
                                        <th>Level</th>
                                        <th>Role</th>
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
