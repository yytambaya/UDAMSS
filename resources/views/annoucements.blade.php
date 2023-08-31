@extends('layouts.app')

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing annoucements">

            <!-- Annocement Modal -->
            <div class="modal fade" id="annoucementModal" tabindex="-1" role="dialog" aria-labelledby="annoucementModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="annoucementModalLabel">New Annoucement</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <h6>Publicity:
                                    <span class="badge badge-secondary">General</span>
                                </h6>
                            </div>
                            <div id="editor-container" class="ql-container ql-snow">
                                <div class="ql-editor" data-gramm="false" contenteditable="true" data-placeholder="Compose an epic...">
                                </div>
                                <div class="ql-clipboard" contenteditable="true" tabindex="-1"></div>
                                <div class="ql-tooltip ql-hidden"><a class="ql-preview" target="_blank" href="about:blank"></a>
                                <input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL">
                                    <a class="ql-action"></a>
                                    <a class="ql-remove"></a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="button" class="btn btn-primary">Post</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- mobile access bar -->
            <div class="col-lg-12 col-sm-12 col-12 layout-spacing sm-access-bar">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="input-group">
                            <div class="input-group-prepend show">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Options </button>
                                <div class="dropdown-menu" style="will-change: transform; position: absolute; transform: translate3d(0px, 46px, 0px); top: 0px; left: 0px;" x-placement="bottom-start">
                                    <a class="dropdown-item btn-outline-success" href="javascript:void(0);" data-toggle="modal" data-target="#annoucementModal">New Annoucement</a>
                                    
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);">General Notice Board</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Staff Notice Board</a>
                                    <a class="dropdown-item" href="javascript:void(0);">400L Notice Board</a>
                                    <a class="dropdown-item" href="javascript:void(0);">300L Notice Board</a>
                                    <a class="dropdown-item" href="javascript:void(0);">200L Notice Board</a>
                                    <a class="dropdown-item" href="javascript:void(0);">100L Notice Board</a>
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" data-toggle="modal" data-target="#annoucementModal" placeholder="New annoucement...">
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- annaocements cards -->
            <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12 annoucements-cards layout-spacing">
                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 px-0">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0 layout-spacing">
                        <div class="widget widget-card-one">
                            <div class="widget-content">
        
                                <div class="media">
                                    <div class="w-img">
                                        <img src="{{ asset( 'assets/img/90x90.jpg' ) }}" alt="avatar">
                                    </div>
                                    <div class="media-body">
                                        <h6>Jimmy Turner</h6>
                                        <p class="meta-date-time">Monday, Nov 18</p>
                                    </div>
                                    <div class="task-action my-auto">
                                        <div class="dropdown  custom-dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
        
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask">
                                                <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Hide</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Block</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <p class="text-justify">"Duis aute irure dolor" in reprehenderit in voluptate velit esse cillum "dolore eu fugiat" nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
        
                                <div class="w-action">
                                    <div class="card-like">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                        <span>551 Likes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0 layout-spacing">
                        <div class="widget widget-card-one">
                            <div class="widget-content">
        
                                <div class="media">
                                    <div class="w-img">
                                        <img src="{{ asset( 'assets/img/90x90.jpg' ) }}" alt="avatar">
                                    </div>
                                    <div class="media-body">
                                        <h6>Jimmy Turner</h6>
                                        <p class="meta-date-time">Monday, Nov 18</p>
                                    </div>
                                    <div class="task-action my-auto">
                                        <div class="dropdown  custom-dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
        
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask">
                                                <a class="dropdown-item" href="javascript:void(0);">Add</a>
                                                <a class="dropdown-item" href="javascript:void(0);">View</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Clear All</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <p>"Duis aute irure dolor" in reprehenderit in voluptate velit esse cillum "dolore eu fugiat" nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
        
                                <div class="w-action">
                                    <div class="card-like">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                        <span>551 Likes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0 layout-spacing">
                        <div class="widget widget-card-one">
                            <div class="widget-content">
        
                                <div class="media">
                                    <div class="w-img">
                                        <img src="{{ asset( 'assets/img/90x90.jpg' ) }}" alt="avatar">
                                    </div>
                                    <div class="media-body">
                                        <h6>Jimmy Turner</h6>
                                        <p class="meta-date-time">Monday, Nov 18</p>
                                    </div>
                                    <div class="task-action my-auto">
                                        <div class="dropdown  custom-dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
        
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask">
                                                <a class="dropdown-item" href="javascript:void(0);">Add</a>
                                                <a class="dropdown-item" href="javascript:void(0);">View</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Clear All</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <p>"Duis aute irure dolor" in reprehenderit in voluptate velit esse cillum "dolore eu fugiat" nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
        
                                <div class="w-action">
                                    <div class="card-like">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                        <span>551 Likes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <!-- desktop access bar -->
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12 fixed-access-bar lg-access-bar">
                <div class="row">
                    <div class="col-12">
                        <div class="widget widget-activity-three">
        
                            <div class="widget-heading">
                                <h5 class="">Annoucements</h5>
                            </div>
                            
                            <div class="widget-content">
                                
                                <div class="form-group">
                                    <input class="form-control" id="exampleFormControlInput1" placeholder="New annoucement..." data-toggle="modal" data-target="#annoucementModal">
                                </div>
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
                                                        <a class="btn btn-outline-success btn-lg" href="javascript:void(0);">General Notice Board</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-outline-secondary btn-lg" href="javascript:void(0);">Staff Notice Board</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-outline-primary btn-lg" href="javascript:void(0);">400L Notice Board</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-outline-primary btn-lg" href="javascript:void(0);">200L Notice Board</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-outline-primary btn-lg" href="javascript:void(0);">300L Notice Board</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-outline-primary btn-lg" href="javascript:void(0);">100L Notice Board</a>
                                                    </td>
                                                </tr>
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
