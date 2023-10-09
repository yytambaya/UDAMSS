@extends('layouts.app')

@php($supervisees = $data['supervisees'])

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-sm-12 col-12 layout-spacing">
                <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="interaction-tab" data-toggle="tab" href="#interaction" role="tab" aria-controls="interaction" aria-selected="false">Interaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="project-workspace-tab" data-toggle="tab" href="#project-workspace" role="tab" aria-controls="project-workspace" aria-selected="false">Project Workspace</a>
                    </li>
                </ul>
                <div class="tab-content" id="simpletabContent">
                    <div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="row">
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="interaction" role="tabpanel" aria-labelledby="interaction-tab">
                        <p class="mb-4">Supervision</p> 
                    </div>
                    <div class="tab-pane fade active show" id="project-workspace" role="tabpanel" aria-labelledby="project-workspace-tab">
                        <div class="row">
                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                                <div class="widget-content widget-content-area br-6">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                                        <h3 class="">Supervisee Information</h3>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                                        <form id="get-supervisee-form" method="post" action="{{route('assign.supervisee')}}">
                                            <fieldset class="form-group border-round p-3 w-auto">
                                                <legend class="badge badge-dark text-left w-auto">Search Supervisee</legend>
                                                <div class="">
                                                    @csrf
                                                    <div class="form-row mb-2">
                                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <label for="supervisory_group_id">Supervisor</label>
                                                            <select id="supervisory_group_id" class="form-control" name="supervisory_group_id">
                                                                <option value="">Choose...</option>
                                                                <option value="" >{{--$supervisory_group->supervisor->getFormattedName()--}}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <label for="student_id">Supervisee</label>
                                                            <select class="form-control" id="student_id" name="student_id">
                                                                <option value="">Choose...</option>
                                                                @foreach([] as $student)
                                                                    <option value="">{{--$student->student->getCapRegno()}} - {{ $student->getFormattedName() --}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-6 col-md-12 col-12">
                                                            <button form="get-supervisee-form" type="submit" class="btn btn-primary">Get Information</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
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
                                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{--$supervisee->getFullName()--}} ({{--$supervisee->getCapRegno()--}})</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0">
                                                            <h6 class="p-0 font-weight-bolder text-monospace">Supervisor:</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="p-0 mb-0  font-weight-plain text-monospace">{{--$supervisor->getFormattedName()--}}</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0">
                                                            <h6 class="p-0 font-weight-bolder text-monospace">Project Topic:</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="p-0 mb-0  font-weight-plain text-monospace">{{--ucwords($project_topic)--}}</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0">
                                                            <h6 class="p-0 font-weight-bolder text-monospace">Progress:</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="p-0 mb-0  font-weight-plain text-monospace">{{--ucwords($project_topic)--}}</h6>
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
                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                                <div class="widget-content widget-content-area br-6">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                                        <h3 class="">Project Documentation Review</h3>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
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
                                                                                <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                            </div>
                                                                            <div class="t-content">
                                                                                <div class="t-uppercontent">
                                                                                    <h5>Collect Docs</h5>
                                                                                    <span class="">10 Mar, 2020</span>
                                                                                </div>
                                                                                <p>Collected documents from <a href="javascript:void(0);">Sara</a></p>
                                                                            </div>
                                                                        </div>           
                                                                    </div>

                                                                    <div class="mb-3 badge badge-success">Documents Review</div>
                                                                    <div class="timeline-line">
                                                                        <div class="item-timeline timeline-new">
                                                                            <div class="t-dot" data-original-title="" title="">
                                                                                <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                            </div>
                                                                            <div class="t-content">
                                                                                <div class="t-uppercontent">
                                                                                    <h5>Chapter 1 Reiview_01</h5>
                                                                                    <span class="">10 Mar, 2020</span>
                                                                                </div>
                                                                                <p>Collected documents from <a href="javascript:void(0);">Sara</a></p>
                                                                            </div>
                                                                        </div>           
                                                                        <div class="item-timeline timeline-new">
                                                                            <div class="t-dot" data-original-title="" title="">
                                                                                <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                                            </div>
                                                                            <div class="t-content">
                                                                                <div class="t-uppercontent">
                                                                                    <h5>Chapter 1 Reiview_02</h5>
                                                                                    <span class="">15 Mar, 2020</span>
                                                                                </div>
                                                                                <p>Collected documents from <a href="javascript:void(0);">Sara</a></p>
                                                                            </div>
                                                                        </div>           
                                                                    </div>
                                                                    <div class="d-flex justify-content-around">
                                                                        <div class="">
                                                                            <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewUploadModal">Review Upload</button>
                                                                            <div class="modal fade" id="reviewUploadModal" tabindex="-1" role="dialog" aria-labelledby="reviewUploadModalLabel" style="display: none;" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="reviewUploadModalLabel">Document Review</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form id="review-upload-form" method="post" action="{{route('supervision.project')}}">
                                                                                                @csrf
                                                                                                <div class="form-row mb-2">
                                                                                                    <div class="form-group col-lg-12 col-md-12 col-12">
                                                                                                        <label for="reviewed-document">Reviewed Document</label>
                                                                                                        <input type="file" class="form-control-file" id="reviewed-document" name="reviewed_document">
                                                                                                    </div>
                                                                                                    <div class="form-group col-lg-12 col-md-12 col-12">
                                                                                                        <label for="review-comment">Review Comment</label>
                                                                                                        <textarea rows="5" class="form-control" id="review-comment" name="review_comment"></textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="modal-footer d-flex justify-content-between">
                                                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                                            <button form="review-upload-form" type="submit" class="btn btn-primary">Review</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="">
                                                                            <button class="btn btn-success">Approve</button>
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
                                                    <div class="card-body">
                                                        <ul class="list-unstyled">
                                                            <li><a href="javascript:void(0);" class="">Apple</a></li>
                                                            <li><a href="javascript:void(0);" class="">Orange</a></li>
                                                            <li><a href="javascript:void(0);" class="">Banana</a></li>
                                                            <li><a href="javascript:void(0);" class="">list</a></li>
                                                        </ul>
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
                                                    <div class="card-body">
                                                    <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>

                                                    <button class="btn btn-primary mt-4">Accept</button>
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
