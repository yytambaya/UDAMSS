@extends('layouts.app')

@php($supervisees = $data['supervisees'])
@php($publicityLabel = $data['publicityLabel'])
@php($supervisory_group = $data['supervisory_group'])
@php($interactions = $data['interactions'])

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing announcements">

            {{-- Announcement Modal --}}
            <div class="modal fade" id="interactionMessage" tabindex="-1" role="dialog" aria-labelledby="interactionMessageLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="interactionMessageLabel">New Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <h6>Publicity:
                                    <span class="badge badge-secondary">{{ucwords($publicityLabel)}}</span>
                                </h6>
                            </div>
                            <div class="mt-2">
                                <form id="post-announcement" method="post" action="{{ route('postinteractionmessage.supervision.project')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="supervisory_group_id" value="{{$supervisory_group['sgid']}}">
                                        <textarea rows="10" name="content" class="form-control" placeholder="Compose an epic..."></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="submit" form="post-announcement" class="btn btn-primary">Post</button>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- mobile access bar --}}
            <div class="col-lg-12 col-sm-12 col-12 layout-spacing sm-access-bar">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="input-group">
                            <div class="input-group-prepend show">
                                <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{ucwords($publicityLabel)}}</button>
                                <div class="dropdown-menu" style="will-change: transform; position: absolute; transform: translate3d(0px, 46px, 0px); top: 0px; left: 0px;" x-placement="bottom-start">
                                    <a class="dropdown-item btn-outline-success" href="javascript:void(0);" data-toggle="modal" data-target="#interactionMessage">New Message</a>
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" data-toggle="modal" data-target="#interactionMessage" placeholder="New message...">
                        </div>
                    </div>
                </div>
            </div>
            
            
            {{-- announcements cards --}} 
            <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12 announcements-cards layout-spacing">
                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 px-0">
                    @forelse($interactions as $interaction)
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0 layout-spacing">
                            <div class="widget widget-card-one">
                                <div class="widget-content">
                                    <div class="media pb-1">
                                        <div class="w-img">
                                            <img src="{{asset('assets/img/90x90.jpg')}}" alt="avatar">
                                        </div>
                                        <div class="media-body">
                                            <h6>{{$interaction['author']}} @if($interaction['isSupervisor'])<span class="text-success text-monospace"> (Supervisor)</span> @else ($interaction['regno']) @endif</h6>
                                            <p class="meta-date-time">{{$interaction['date']}}</p>
                                        </div>
                                        @if($interaction['isPostAuthor'])
                                        <div class="task-action my-auto">
                                            <div class="dropdown  custom-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="options">
                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateMeassage-{{$interaction['id']}}">Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#deleteMessage-{{$interaction['id']}}">Delete</a>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="updateMeassage-{{$interaction['id']}}" tabindex="-1" role="dialog" aria-labelledby="updateMeassage-{{$interaction['id']}}Label" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="updateMeassage-{{$interaction['id']}}Label">Update Message</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-4">
                                                                <h6>Publicity:
                                                                    <span class="badge badge-secondary">{{ucwords($publicityLabel)}}</span>
                                                                </h6>
                                                            </div>
                                                            <div class="mt-2">
                                                                <form id="edit-message-{{$interaction['id']}}" method="post" action="{{ route('editinteractionmessage.interaction.supervision.project')}}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="message_id" value="{{$interaction['id']}}">
                                                                        <textarea rows="10" name="content" class="form-control" placeholder="Compose an epic...">{{old('content', $interaction['content'])}}</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-around">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                            <button type="submit" form="edit-message-{{$interaction['id']}}" class="btn btn-warning">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="deleteMessage-{{$interaction['id']}}" tabindex="-1" role="dialog" aria-labelledby="deleteMessage-{{$interaction['id']}}Label" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteMessage-{{$interaction['id']}}Label">Confirm Message Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-4">
                                                                <h3 class="text-center">Are You Sure?</h3>
                                                                <h6 class="text-center">You want to delete this message.</h6>
                                                                <p class="text-center text-danger">You can't undo this action</p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <form id="delete-message-{{$interaction['id']}}" method="post" action="{{ route('deleteinteractionmessage.interaction.supervision.project')}}">
                                                                    @csrf
                                                                    <input type="hidden" name="message_id" value="{{$interaction['id']}}">
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-around">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                            <button type="submit" form="delete-message-{{$interaction['id']}}" class="btn btn-danger">Yes, delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <p class="text-justify" style="white-space: pre-wrap">{{ $interaction['content']}}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-danger lead">No Messages Yet!</p>
                    @endforelse
                </div>
            </div>

             {{-- desktop access bar --}} 
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12 fixed-access-bar lg-access-bar">
                <div class="row">
                    <div class="col-12">
                        <div class="widget widget-activity-three">
        
                            <div class="widget-heading">
                                <h5 class="">{{$supervisory_group['supervisor']}} - Interaction</h5>
                            </div>
                            
                            <div class="widget-content">
                                <div class="form-group">
                                    <input class="form-control" id="exampleFormControlInput1" placeholder="New message..." data-toggle="modal" data-target="#interactionMessage">
                                </div>
                                <div class="mt-container px-0 mx-auto">
                                    <div class="table-responsive">
                                        <table class="table table-bordered notice-boards mb-4">
                                            <thead>
                                                <tr>
                                                    <th>supervisees</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($supervisees as $supervisee)
                                                <tr>
                                                    <td>@php($sveid = $supervisee['id'])
                                                        <a class="" href="javascript:void()"
                                                            onclick="event.preventDefault();
                                                            document.getElementById('workspace-form-{{$sveid}}').submit();">
                                                            <form id="workspace-form-{{$sveid}}" action="{{ route('post.workspace.supervision.project') }}" method="POST" class="d-none">
                                                                @csrf
                                                                <input type="hidden" name="supervisory_group_id" value="{{$supervisory_group['sgid']}}">
                                                                <input type="hidden" name="supervisee_id" value="{{$supervisee['id']}}">
                                                            </form>
                                                        {{$supervisee['regno']}} - {{$supervisee['name']}}</a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td>
                                                        <a class="text-danger" href="javascript:void()">No supervisees assigned!</a>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
