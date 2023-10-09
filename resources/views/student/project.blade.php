@extends('layouts.app')

@php($supervisory_groups = $data['supervisory_groups'])
@php($supervisee = $data['supervisee'])
@php($supervisor = $data['supervisor'])
@php($project_topic = $data['project_topic'])

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 mb-3">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-xl-11 col-lg-6 col-md-12 col-sm-12">
                        <h3 class="">Project Work Information</h3>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 my-3">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="p-0">
                                            <h6 class="p-0 font-weight-bolder text-monospace">Supervisee:</h6>
                                        </td>
                                        <td>
                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{$supervisee->getFullName()}} ({{$supervisee->getCapRegno()}})</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">
                                            <h6 class="p-0 font-weight-bolder text-monospace">Supervisor:</h6>
                                        </td>
                                        <td>
                                            <h6 class="p-0 mb-0  font-weight-plain text-monospace">{{$supervisor->getFormattedName()}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">
                                            <h6 class="p-0 font-weight-bolder text-monospace">Project Topic:</h6>
                                        </td>
                                        <td>
                                            <h6 class="p-0 mb-0  font-weight-plain text-monospace">{{ucwords($project_topic)}}</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 layout-spacing">
                <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Submission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="interaction-tab" data-toggle="tab" href="#interaction" role="tab" aria-controls="interaction" aria-selected="false">Interaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="project-workspace-tab" data-toggle="tab" href="#project-workspace" role="tab" aria-controls="project-workspace" aria-selected="false">Project Workspace</a>
                    </li>
                </ul>
                <div class="tab-content" id="simpletabContent">
                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="row">
                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                                <div id="toggleAccordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne1">
                                            <section class="mb-0 mt-0">
                                                <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne" aria-expanded="false" aria-controls="defaultAccordionOne">
                                                    Chapter 1: Introduction  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
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
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter 1.0.0</h5>
                                                                            <span class="">10 Mar, 2020</span>
                                                                        </div>
                                                                        <p>Preliminary pages and chapter 1</a></p>
                                                                        <div class="tags">
                                                                            <a href="" target="_blank">
                                                                                <div class="badge badge-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                                                                </div>
                                                                            </a>
                                                                            <a href="">
                                                                                <div class="badge badge-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>           
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter 1.0.1</h5>
                                                                            <span class="">10 Mar, 2020</span>
                                                                        </div>
                                                                        <p>Updated background and scope and limitation</a></p>
                                                                        <div class="tags">
                                                                            <a href="" target="_blank">
                                                                                <div class="badge badge-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                                                                </div>
                                                                            </a>
                                                                            <a href="">
                                                                                <div class="badge badge-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>           
                                                            </div>

                                                            <div class="mb-3 badge badge-success">Documents Review</div>

                                                            <div class="timeline-line">
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter 1.0.0 review</h5>
                                                                            <span class="">10 Mar, 2020</span>
                                                                        </div>
                                                                        <p>Background is extremly scanty, and vague scope and limitation</a></p>
                                                                        <div class="tags">
                                                                            <a href="" target="_blank">
                                                                                <div class="badge badge-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                                                                </div>
                                                                            </a>
                                                                            <a href="">
                                                                                <div class="badge badge-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>       
                                                            </div>
                                                            
                                                            <div class="mt-5">
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
                                                                                <button form="ch1-document-upload-form" type="submit" class="btn btn-primary">Review</button>
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
                                    <div class="card">
                                        <div class="card-header" id="headingTwo1">
                                            <section class="mb-0 mt-0">
                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionTwo" aria-expanded="false" aria-controls="defaultAccordionTwo">
                                            Chapter 2: Literature Review   <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
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
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter 2.0.0</h5>
                                                                            <span class="">10 Mar, 2020</span>
                                                                        </div>
                                                                        <p>Introduction and conceptual framework</a></p>
                                                                        <div class="tags">
                                                                            <a href="" target="_blank">
                                                                                <div class="badge badge-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                                                                </div>
                                                                            </a>
                                                                            <a href="">
                                                                                <div class="badge badge-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>           
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter 2.0.1</h5>
                                                                            <span class="">10 Mar, 2020</span>
                                                                        </div>
                                                                        <p>Added proper citations in the conceptual framework</a></p>
                                                                        <div class="tags">
                                                                            <a href="" target="_blank">
                                                                                <div class="badge badge-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                                                                </div>
                                                                            </a>
                                                                            <a href="">
                                                                                <div class="badge badge-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>           
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter 2.0.2</h5>
                                                                            <span class="">10 Mar, 2020</span>
                                                                        </div>
                                                                        <p>Reviewed related works properly cited and paraphrased</a></p>
                                                                        <div class="tags">
                                                                            <a href="" target="_blank">
                                                                                <div class="badge badge-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                                                                </div>
                                                                            </a>
                                                                            <a href="">
                                                                                <div class="badge badge-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>           
                                                            </div>

                                                            <div class="mb-3 badge badge-success">Documents Review</div>

                                                            <div class="timeline-line">
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter 2.0.0 review</h5>
                                                                            <span class="">10 Mar, 2020</span>
                                                                        </div>
                                                                        <p>Conceptual framework should cite theoretical concept related to your work!</a></p>
                                                                        <div class="tags">
                                                                            <a href="" target="_blank">
                                                                                <div class="badge badge-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                                                                </div>
                                                                            </a>
                                                                            <a href="">
                                                                                <div class="badge badge-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>       
                                                                <div class="item-timeline timeline-new">
                                                                    <div class="t-dot" data-original-title="" title="">
                                                                        <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                    </div>
                                                                    <div class="t-content">
                                                                        <div class="t-uppercontent">
                                                                            <h5>Chapter 2.0.1 review</h5>
                                                                            <span class="">10 Mar, 2020</span>
                                                                        </div>
                                                                        <p>Cite the existing work related to your project that you have reviewed. Less quoting, more paraphrasing.</a></p>
                                                                        <div class="tags">
                                                                            <a href="" target="_blank">
                                                                                <div class="badge badge-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                                                                </div>
                                                                            </a>
                                                                            <a href="">
                                                                                <div class="badge badge-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>       
                                                            </div>
                                                            
                                                            <div class="mt-5">
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
                                                                                <button form="ch2-document-upload-form" type="submit" class="btn btn-primary">Review</button>
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
                                    <div class="card">
                                        <div class="card-header" id="headingThree1">
                                            <section class="mb-0 mt-0">
                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionThree" aria-expanded="false" aria-controls="defaultAccordionThree">
                                            Chapter 3: Methodology  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                            </div>
                                            </section>
                                        </div>
                                        <div id="defaultAccordionThree" class="collapse" aria-labelledby="headingThree1" data-parent="#toggleAccordion" style="">
                                            <div class="card-body p-0">
                                                <p class="p-3 text-danger">No uploads yet</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFour1">
                                            <section class="mb-0 mt-0">
                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionFour" aria-expanded="false" aria-controls="defaultAccordionFour">
                                            Chapter 4: Implementation and Discussion of Result  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                            </div>
                                            </section>
                                        </div>
                                        <div id="defaultAccordionFour" class="collapse" aria-labelledby="headingFour1" data-parent="#toggleAccordion" style="">
                                            <div class="card-body p-0">
                                                <p class="p-3 text-danger">No uploads yet</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFive1">
                                            <section class="mb-0 mt-0">
                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionFive" aria-expanded="false" aria-controls="defaultAccordionFive">
                                            Chapter 5: Summary, Conclusion and Recommendations  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                            </div>
                                            </section>
                                        </div>
                                        <div id="defaultAccordionFive" class="collapse" aria-labelledby="headingFive1" data-parent="#toggleAccordion" style="">
                                            <div class="card-body p-0">
                                                <p class="p-3 text-danger">No uploads yet</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                                <div class="widget-content widget-content-area br-6">
                                    <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 mb-5">
                                        <h3 class="">Project Information Submission</h3>
                                    </div>
                                    <form id="assgin-supervisee" method="post" action="{{route('submit.supervisee')}}">
                                        <fieldset class="form-group border-round p-3 w-auto">
                                            <legend class="badge badge-dark text-left w-auto">Submit Project Information</legend>
                                            <div class="">
                                                @csrf
                                                <div class="form-row mb-4">
                                                    <div class="form-group col-lg-6 col-md-12 col-12">
                                                        <label for="supervisory_group_id">Supervisor</label>
                                                        <select id="supervisory_group_id" class="form-control" name="supervisory_group_id">
                                                            <option value="">Choose...</option>
                                                            @foreach($supervisory_groups as $supervisory_group)
                                                            <option value="{{$supervisory_group->id}}" @selected(old('supervisory_group_id') == $supervisory_group->id)>
                                                                {{$supervisory_group->supervisor->getFormattedName()}}
                                                            </option>
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
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="interaction" role="tabpanel" aria-labelledby="interaction-tab">
                        <p class="mb-4">Interaction</p> 
                    </div>
                    <div class="tab-pane fade" id="project-workspace" role="tabpanel" aria-labelledby="project-workspace-tab">
                        <p class="mb-4">Workspace</p> 
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
