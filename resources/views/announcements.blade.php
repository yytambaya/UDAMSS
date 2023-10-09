@extends('layouts.app')

@php

$isLecturer = false;
$isClassRep = false;
$publicity = $data['publicity'];

if(in_array($publicity, ['4','3','2','1'])):
    $publicityLabel = "{$publicity}00L";
else:
    $publicityLabel = "$publicity";
endif;

if( Auth::user()->isLecturer() ):
    $isLecturer = true;
endif;

if(Auth::user()->isStudent()):
    $isClassRep = Auth::user()->isClassRep();
    $level = Auth::user()->student->level;
endif;

@endphp

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing announcements">

            {{-- Announcement Modal --}}
            @if(Auth::user()->isLecturer())
            <div class="modal fade" id="announcementModal" tabindex="-1" role="dialog" aria-labelledby="announcementModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="announcementModalLabel">New Announcement</h5>
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
                                <form id="post-announcement" method="post" action="{{ route('post.general.announcement')}}">
                                    @csrf
                                    <input type="hidden" name="publicity" value="general">
                                    <div class="form-group">
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
            @endif
            
            {{-- mobile access bar --}}
            <div class="col-lg-12 col-sm-12 col-12 layout-spacing sm-access-bar">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="input-group">
                            <div class="input-group-prepend show">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{ucwords($publicityLabel)}}</button>
                                <div class="dropdown-menu" style="will-change: transform; position: absolute; transform: translate3d(0px, 46px, 0px); top: 0px; left: 0px;" x-placement="bottom-start">
                                    <a class="dropdown-item btn-outline-success" href="javascript:void(0);" data-toggle="modal" data-target="#announcementModal">New Announcement</a>
                                    
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('general.announcement')}}">General Notice Board</a>

                                    @if($isLecturer)
                                    <a class="dropdown-item" href="{{route('staff.announcement')}}">Staff Notice Board</a>
                                    @endif
                                    
                                    @if($isLecturer or $level == '4')
                                    <a class="dropdown-item" href="{{route('level4.announcement')}}">400L Notice Board</a>
                                    @endif
                                    
                                    @if($isLecturer or $level == '3')
                                    <a class="dropdown-item" href="{{route('level3.announcement')}}">300L Notice Board</a>
                                    @endif
                                    
                                    @if($isLecturer or $level == '2')
                                    <a class="dropdown-item" href="{{route('level2.announcement')}}">200L Notice Board</a>
                                    @endif
                                
                                    @if($isLecturer or $level == '1')
                                    <a class="dropdown-item" href="{{route('level1.announcement')}}">100L Notice Board</a>
                                    @endif
                                </div>
                            </div>
                            @if(Auth::user()->isLecturer())
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" data-toggle="modal" data-target="#announcementModal" placeholder="New announcement...">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- announcements cards --}} 
            <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12 announcements-cards layout-spacing">

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 px-0">

                    @forelse ($data['announcements'] as $announcement)
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0 layout-spacing">
                            <div class="widget widget-card-one">
                                <div class="widget-content">
            
                                    <div class="media">
                                        <div class="w-img">
                                            <img src="{{asset('assets/img/90x90.jpg')}}" alt="avatar">
                                        </div>
                                        <div class="media-body">
                                            <h6>{{$announcement->user->getFormattedName()}}</h6>
                                            <p class="meta-date-time">{{$announcement->postedDate()}}</p>
                                        </div>
                                        @if($announcement->isPostAuthour() )
                                        <div class="task-action my-auto">
                                            <div class="dropdown  custom-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="options">
                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateAnnouncement-{{$announcement->id}}">Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#deleteAnnouncement-{{$announcement->id}}">Delete</a>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="updateAnnouncement-{{$announcement->id}}" tabindex="-1" role="dialog" aria-labelledby="updateAnnouncement-{{$announcement->id}}Label" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="updateAnnouncement-{{$announcement->id}}Label">Update Announcement</h5>
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
                                                                <form id="edit-message" method="post" action="{{ route('edit.general.announcement')}}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="announcement_id" value="{{$announcement->id}}">
                                                                        <textarea rows="10" name="content" class="form-control" placeholder="Compose an epic...">{{old('content', $announcement->content)}}</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-around">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                            <button type="submit" form="edit-message" class="btn btn-warning">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="deleteAnnouncement-{{$announcement->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteAnnouncement-{{$announcement->id}}Label" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteAnnouncement-{{$announcement->id}}Label">Confirm Message Deletion</h5>
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
                                                                <form id="delete-message" method="post" action="{{ route('delete.general.announcement')}}">
                                                                    @csrf
                                                                    <input type="hidden" name="announcement_id" value="{{$announcement->id}}">
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-around">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                            <button type="submit" form="delete-message" class="btn btn-danger">Yes, delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
            
                                    <p class="text-justify" style="white-space: pre-wrap">{{ $announcement->content}}</p>
            
                                    <div class="w-action">
                                        <div class="card-like">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                            <span>{{$announcement->likes}} Likes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-danger lead">No Announcements Yet!</p>
                    @endforelse


                </div>
            </div>

             <!--  -->
             {{-- desktop access bar --}} 
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12 fixed-access-bar lg-access-bar">
                <div class="row">
                    <div class="col-12">
                        <div class="widget widget-activity-three">
        
                            <div class="widget-heading">
                                <h5 class="">Announcements</h5>
                            </div>
                            
                            <div class="widget-content">
                                @if(Auth::user()->isLecturer())
                                <div class="form-group">
                                    <input class="form-control" id="exampleFormControlInput1" placeholder="New announcement..." data-toggle="modal" data-target="#announcementModal">
                                </div>
                                @endif
                                <div class="mt-container px-0 mx-auto">
                                    <div class="table-responsive">
                                        <table class="table table-bordered notice-boards mb-4">
                                            <thead>
                                                <tr>
                                                    <th>Notice Boards</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-success btn-lg" href="{{route('general.announcement')}}">General Notice Board</a>
                                                    </td>
                                                </tr>

                                                @if($isLecturer)
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-outline-secondary btn-lg" href="{{route('staff.announcement')}}">Staff Notice Board</a>
                                                    </td>
                                                </tr>
                                                @endif
                                            
                                                @if($isLecturer or $level == '4')
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-outline-primary btn-lg" href="{{route('level4.announcement')}}">400L Notice Board</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                
                                                @if($isLecturer or $level == '3')
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-outline-primary btn-lg" href="{{route('level3.announcement')}}">300L Notice Board</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                
                                                @if($isLecturer or $level == '2')
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-outline-primary btn-lg" href="{{route('level2.announcement')}}">200L Notice Board</a>
                                                    </td>
                                                </tr>
                                                @endif
                                            
                                                @if($isLecturer or $level == '1')
                                                    <tr>
                                                        <td>
                                                            <a class="btn btn-outline-primary btn-lg" href="{{route('level1.announcement')}}">100L Notice Board</a>
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
