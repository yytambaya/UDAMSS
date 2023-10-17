@extends('layouts.app')

@php($supervisees = [])
@php($supervisory_group = [])

@php($supervisor = $data['supervisor'])
@php($supervisee = $data['supervisee'])
@php($documentation = $data['documentation'])

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 layout-spacing mb-4 mt-5">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h3 class="">Project Workspace @if($supervisee) <span class="text-success text-monospace font-weight-bold lead"> {{'- '.$supervisee['name']}} </span> @endif</h3>
                </div>
            </div>
            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 my-3">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="p-2">
                                            <h6 class="p-0 mb-0 font-weight-bolder text-monospace">Supervisor:</h6>
                                        </td>
                                        <td>
                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{$supervisor}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2">
                                            <h6 class="p-0 mb-0 font-weight-bolder text-monospace">Supervisee:</h6>
                                        </td>
                                        <td>
                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{$supervisee['name']}} ({{$supervisee['regno']}})</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2">
                                            <h6 class="p-0 mb-0 font-weight-bolder text-monospace">Project Topic:</h6>
                                        </td>
                                        <td>
                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{$supervisee['topic']}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2">
                                            <h6 class="p-0 mb-0 font-weight-bolder text-monospace">Progress:</h6>
                                        </td>
                                        <td>
                                            <div class="progress br-30">
                                                @if($documentation['progress'])
                                                <div class="progress-bar @if($documentation['progress']==100)bg-success @else bg-primary @endif" role="progressbar" style="width: {{$documentation['progress']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-title"><span>{{$documentation['progress']}}%</span></div>
                                                </div>
                                                @else
                                                <span class="text-dark text-monospace d-flex justify-content-center align-items-center">{{$documentation['progress']}}%</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                        <h3 class="">Documentation Review</h3>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                        <div id="toggleAccordion">
                            <div class="card">
                                <div class="card-header" id="headingOne1">
                                    <section class="mb-0 mt-0">
                                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne" aria-expanded="false" aria-controls="defaultAccordionOne">
                                                Chapter 1: Introduction  @if(isset($documentation['chapter1']) && $documentation['chapter1']['status'] == 'approved')<span class="text-sm text-success ml-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>@endif
                                                <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                        </div>
                                    </section>
                                </div>

                                <div id="defaultAccordionOne" class="collapse" aria-labelledby="headingOne1" data-parent="#toggleAccordion" style="">
                                    <div class="card-body p-0">
                                        <div class="widget-activity-three">
                                            <div class="widget-content py-4 px-0">
                                                <div class="mt-container mx-auto">
                                                    <div class="mb-3 badge badge-primary">Documents Uploads</div>

                                                    <div class="timeline-line mb-3">
                                                        @if(isset($documentation['chapter1']))
                                                            @foreach($documentation['chapter1']['documents'] as $document)
                                                                @if($document['type'] == 'upload')
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter {{$document['chapter_no'].'.'.$document['version']}}</h5>
                                                                            <span class="">{{$document['date']}}</span>
                                                                        </div>
                                                                        <p>{{ucfirst($document['comment'])}}<a class="ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a></p>
                                                                        <div class="tags">
                                                                            <a href="">
                                                                                <div class="badge badge-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                                    &nbsp;&nbsp;Download
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif                    
                                                    </div>

                                                    <div class="mb-3 badge badge-danger">Documents Review</div>

                                                    <div class="timeline-line mb-3">
                                                        @if(isset($documentation['chapter1']))
                                                            @foreach($documentation['chapter1']['documents'] as $document)
                                                                @if($document['type'] == 'review')
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter {{$document['chapter_no'].'.'.$document['version']}}</h5>
                                                                            <span class="">{{$document['date']}}</span>
                                                                        </div>
                                                                        <p>{{ucfirst($document['comment'])}}</p>
                                                                        <div class="tags">
                                                                            <a href="">
                                                                                <div class="badge badge-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                                    &nbsp;&nbsp;Download
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="mt-5 d-flex justify-content-center">
                                                        @if(isset($documentation['chapter1']) && $documentation['chapter1']['status'] == 'approved')
                                                        <h4 class="badge badge-success">Chapter Approved</h4>
                                                        @else
                                                        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#ch1-newUploadModal">New Upload</button>
                                                        <div class="modal fade" id="ch1-newUploadModal" tabindex="-1" role="dialog" aria-labelledby="ch1-newUploadModalLabel" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ch1-newUploadModalLabel">Chapter 1 Document Upload</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="ch1-document-upload-form" method="post" action="{{route('upload.student.workspace.project')}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="chapter_no" value="1">
                                                                            <div class="form-row">
                                                                                <div class="form-group col-lg-12 col-md-12 col-12">
                                                                                    <label for="uploaded-document">Document</label>
                                                                                    <input type="file" class="form-control-file" id="uploaded-document" name="document">
                                                                                </div>
                                                                                <div class="form-group col-lg-12 col-md-12 col-12 mb-0">
                                                                                    <label for="upload-summary">Summary</label>
                                                                                    <textarea rows="2" class="form-control" id="upload-summary" name="comment"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer d-flex justify-content-between">
                                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                        <button form="ch1-document-upload-form" type="submit" class="btn btn-primary">Upload</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo1">
                                    <section class="mb-0 mt-0">
                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionTwo" aria-expanded="false" aria-controls="defaultAccordionTwo">
                                        Chapter 2: Literature Review   @if(isset($documentation['chapter2']) && $documentation['chapter2']['status'] == 'approved')<span class="text-sm text-success ml-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>@endif
                                        <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                    </div>
                                    </section>
                                </div>
                                <div id="defaultAccordionTwo" class="collapse" aria-labelledby="headingTwo1" data-parent="#toggleAccordion" style="">
                                <div class="card-body p-0">
                                        <div class="widget-activity-three">
                                            <div class="widget-content py-4 px-0">
                                                <div class="mt-container mx-auto">
                                                    <div class="mb-3 badge badge-primary">Documents Uploads</div>

                                                    <div class="timeline-line mb-3">
                                                        @if(isset($documentation['chapter2']))
                                                            @foreach($documentation['chapter2']['documents'] as $document)
                                                                @if($document['type'] == 'upload')
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter {{$document['chapter_no'].'.'.$document['version']}}</h5>
                                                                            <span class="">{{$document['date']}}</span>
                                                                        </div>
                                                                        <p>{{ucfirst($document['comment'])}}<a class="ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a></p>
                                                                        <div class="tags">
                                                                            <a href="">
                                                                                <div class="badge badge-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                                    &nbsp;&nbsp;Download
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3 badge badge-danger">Documents Review</div>

                                                    <div class="timeline-line mb-3">
                                                        @if(isset($documentation['chapter2']))
                                                            @foreach($documentation['chapter2']['documents'] as $document)
                                                                @if($document['type'] == 'review')
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter {{$document['chapter_no'].'.'.$document['version']}}</h5>
                                                                            <span class="">{{$document['date']}}</span>
                                                                        </div>
                                                                        <p>{{ucfirst($document['comment'])}}</p>
                                                                        <div class="tags">
                                                                            <a href="">
                                                                                <div class="badge badge-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                                    &nbsp;&nbsp;Download
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="mt-5 d-flex justify-content-center">
                                                        @if(isset($documentation['chapter2']) && $documentation['chapter2']['status'] == 'approved')
                                                        <h4 class="badge badge-success">Chapter Approved</h4>
                                                        @else
                                                        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#ch2-newUploadModal">New Upload</button>
                                                        <div class="modal fade" id="ch2-newUploadModal" tabindex="-1" role="dialog" aria-labelledby="ch2-newUploadModalLabel" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ch2-newUploadModalLabel">Chapter 2 Document Upload</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="ch2-document-upload-form" method="post" action="{{route('upload.student.workspace.project')}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="chapter_no" value="2">
                                                                            <div class="form-row">
                                                                                <div class="form-group col-lg-12 col-md-12 col-12">
                                                                                    <label for="uploaded-document">Document</label>
                                                                                    <input type="file" class="form-control-file" id="uploaded-document" name="document">
                                                                                </div>
                                                                                <div class="form-group col-lg-12 col-md-12 col-12 mb-0">
                                                                                    <label for="upload-comment">Summary</label>
                                                                                    <textarea rows="2" class="form-control" id="upload-comment" name="comment"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer d-flex justify-content-between">
                                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                        <button form="ch2-document-upload-form" type="submit" class="btn btn-primary">Upload</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree1">
                                    <section class="mb-0 mt-0">
                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionThree" aria-expanded="false" aria-controls="defaultAccordionThree">
                                        Chapter 3: Methodology  @if(isset($documentation['chapter3']) && $documentation['chapter3']['status'] == 'approved')<span class="text-sm text-success ml-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>@endif
                                        <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                    </div>
                                    </section>
                                </div>
                                <div id="defaultAccordionThree" class="collapse" aria-labelledby="headingThree1" data-parent="#toggleAccordion" style="">
                                    <div class="card-body p-0">
                                        <div class="widget-activity-three">
                                            <div class="widget-content py-4 px-0">
                                                <div class="mt-container mx-auto">
                                                    <div class="mb-3 badge badge-primary">Documents Uploads</div>

                                                    <div class="timeline-line mb-3">
                                                        @if(isset($documentation['chapter3']))
                                                            @forelse($documentation['chapter3']['documents'] as $document)
                                                                @if($document['type'] == 'upload')
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter {{$document['chapter_no'].'.'.$document['version']}}</h5>
                                                                            <span class="">{{$document['date']}}</span>
                                                                        </div>
                                                                        <p>{{ucfirst($document['comment'])}}<a class="ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a></p>
                                                                        <div class="tags">
                                                                            <a href="">
                                                                                <div class="badge badge-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                                    &nbsp;&nbsp;Download
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif 
                                                            @empty         
                                                            <p class="p-3 text-danger">No uploads yet</p>
                                                            @endforelse
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3 badge badge-danger">Documents Review</div>

                                                    <div class="timeline-line mb-3">
                                                        @if(isset($documentation['chapter3']))
                                                            @foreach($documentation['chapter3']['documents'] as $document)
                                                                @if($document['type'] == 'review')
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter {{$document['chapter_no'].'.'.$document['version']}}</h5>
                                                                            <span class="">{{$document['date']}}</span>
                                                                        </div>
                                                                        <p>{{ucfirst($document['comment'])}}</p>
                                                                        <div class="tags">
                                                                            <a href="">
                                                                                <div class="badge badge-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                                    &nbsp;&nbsp;Download
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="mt-5 d-flex justify-content-center">
                                                        @if(isset($documentation['chapter3']) && $documentation['chapter3']['status'] == 'approved')
                                                        <h4 class="badge badge-success">Chapter Approved</h4>
                                                        @else
                                                        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#ch3-newUploadModal">New Upload</button>
                                                        <div class="modal fade" id="ch3-newUploadModal" tabindex="-1" role="dialog" aria-labelledby="ch3-newUploadModalLabel" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ch3-newUploadModalLabel">Chapter 3 Document Upload</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="ch3-document-upload-form" method="post" action="{{route('upload.student.workspace.project')}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="chapter_no" value="3">
                                                                            <div class="form-row">
                                                                                <div class="form-group col-lg-12 col-md-12 col-12">
                                                                                    <label for="uploaded-document">Document</label>
                                                                                    <input type="file" class="form-control-file" id="uploaded-document" name="document">
                                                                                </div>
                                                                                <div class="form-group col-lg-12 col-md-12 col-12 mb-0">
                                                                                    <label for="upload-comment">Summary</label>
                                                                                    <textarea rows="2" class="form-control" id="upload-comment" name="comment"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer d-flex justify-content-between">
                                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                        <button form="ch3-document-upload-form" type="submit" class="btn btn-primary">Upload</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour1">
                                    <section class="mb-0 mt-0">
                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionFour" aria-expanded="false" aria-controls="defaultAccordionFour">
                                        Chapter 4: Implementation and Discussion of Result  @if(isset($documentation['chapter4']) && $documentation['chapter4']['status'] == 'approved')<span class="text-sm text-success ml-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>@endif
                                        <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                    </div>
                                    </section>
                                </div>
                                <div id="defaultAccordionFour" class="collapse" aria-labelledby="headingFour1" data-parent="#toggleAccordion" style="">
                                    <div class="card-body p-0">
                                        <div class="widget-activity-three">
                                            <div class="widget-content py-4 px-0">
                                                <div class="mt-container mx-auto">
                                                    <div class="mb-3 badge badge-primary">Documents Uploads</div>

                                                    <div class="timeline-line mb-3">
                                                        @if(isset($documentation['chapter4']))
                                                            @foreach($documentation['chapter4']['documents'] as $document)
                                                                @if($document['type'] == 'upload')
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter {{$document['chapter_no'].'.'.$document['version']}}</h5>
                                                                            <span class="">{{$document['date']}}</span>
                                                                        </div>
                                                                        <p>{{ucfirst($document['comment'])}}<a class="ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a></p>
                                                                        <div class="tags">
                                                                            <a href="">
                                                                                <div class="badge badge-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                                    &nbsp;&nbsp;Download
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3 badge badge-danger">Documents Review</div>

                                                    <div class="timeline-line mb-3">
                                                        @if(isset($documentation['chapter4']))
                                                            @foreach($documentation['chapter4']['documents'] as $document)
                                                                @if($document['type'] == 'review')
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter {{$document['chapter_no'].'.'.$document['version']}}</h5>
                                                                            <span class="">{{$document['date']}}</span>
                                                                        </div>
                                                                        <p>{{ucfirst($document['comment'])}}</p>
                                                                        <div class="tags">
                                                                            <a href="">
                                                                                <div class="badge badge-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                                    &nbsp;&nbsp;Download
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="mt-5 d-flex justify-content-center">
                                                        @if(isset($documentation['chapter4']) && $documentation['chapter4']['status'] == 'approved')
                                                        <h4 class="badge badge-success">Chapter Approved</h4>
                                                        @else
                                                        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#ch4-newUploadModal">New Upload</button>
                                                        <div class="modal fade" id="ch4-newUploadModal" tabindex="-1" role="dialog" aria-labelledby="ch4-newUploadModalLabel" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ch4-newUploadModalLabel">Chapter 4 Document Upload</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="ch4-document-upload-form" method="post" action="{{route('upload.student.workspace.project')}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="chapter_no" value="4">
                                                                            <div class="form-row">
                                                                                <div class="form-group col-lg-12 col-md-12 col-12">
                                                                                    <label for="uploaded-document">Document</label>
                                                                                    <input type="file" class="form-control-file" id="uploaded-document" name="document">
                                                                                </div>
                                                                                <div class="form-group col-lg-12 col-md-12 col-12 mb-0">
                                                                                    <label for="upload-comment">Summary</label>
                                                                                    <textarea rows="2" class="form-control" id="upload-comment" name="comment"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer d-flex justify-content-between">
                                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                        <button form="ch4-document-upload-form" type="submit" class="btn btn-primary">Upload</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFive1">
                                    <section class="mb-0 mt-0">
                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionFive" aria-expanded="false" aria-controls="defaultAccordionFive">
                                        Chapter 5: Summary, Conclusion and Recommendations  @if(isset($documentation['chapter5']) && $documentation['chapter5']['status'] == 'approved')<span class="text-sm text-success ml-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>@endif
                                        <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                    </div>
                                    </section>
                                </div>
                                <div id="defaultAccordionFive" class="collapse" aria-labelledby="headingFive1" data-parent="#toggleAccordion" style="">
                                    <div class="card-body p-0">
                                        <div class="widget-activity-three">
                                            <div class="widget-content py-4 px-0">
                                                <div class="mt-container mx-auto">
                                                    <div class="mb-3 badge badge-primary">Documents Uploads</div>

                                                    <div class="timeline-line mb-3">
                                                        @if(isset($documentation['chapter5']))
                                                            @foreach($documentation['chapter5']['documents'] as $document)
                                                                @if($document['type'] == 'upload')
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter {{$document['chapter_no'].'.'.$document['version']}}</h5>
                                                                            <span class="">{{$document['date']}}</span>
                                                                        </div>
                                                                        <p>{{ucfirst($document['comment'])}}<a class="ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a></p>
                                                                        <div class="tags">
                                                                            <a href="">
                                                                                <div class="badge badge-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                                    &nbsp;&nbsp;Download
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3 badge badge-danger">Documents Review</div>

                                                    <div class="timeline-line mb-3">
                                                        @if(isset($documentation['chapter5']))
                                                            @foreach($documentation['chapter5']['documents'] as $document)
                                                                @if($document['type'] == 'review')
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter {{$document['chapter_no'].'.'.$document['version']}}</h5>
                                                                            <span class="">{{$document['date']}}</span>
                                                                        </div>
                                                                        <p>{{ucfirst($document['comment'])}}</p>
                                                                        <div class="tags">
                                                                            <a href="">
                                                                                <div class="badge badge-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                                    &nbsp;&nbsp;Download
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="mt-5 d-flex justify-content-center">
                                                        @if(isset($documentation['chapter5']) && $documentation['chapter5']['status'] == 'approved')
                                                        <h4 class="badge badge-success">Chapter Approved</h4>
                                                        @else
                                                        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#ch5-newUploadModal">New Upload</button>
                                                        <div class="modal fade" id="ch5-newUploadModal" tabindex="-1" role="dialog" aria-labelledby="ch5-newUploadModalLabel" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ch5-newUploadModalLabel">Chapter 5 Document Upload</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="ch5-document-upload-form" method="post" action="{{route('upload.student.workspace.project')}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="chapter_no" value="5">
                                                                            <div class="form-row">
                                                                                <div class="form-group col-lg-12 col-md-12 col-12">
                                                                                    <label for="uploaded-document">Document</label>
                                                                                    <input type="file" class="form-control-file" id="uploaded-document" name="document">
                                                                                </div>
                                                                                <div class="form-group col-lg-12 col-md-12 col-12 mb-0">
                                                                                    <label for="upload-comment">Summary</label>
                                                                                    <textarea rows="2" class="form-control" id="upload-comment" name="comment"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer d-flex justify-content-between">
                                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                        <button form="ch5-document-upload-form" type="submit" class="btn btn-primary">Upload</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
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
