@extends('layouts.app')

@php($supervisory_groups = $data['supervisory_groups'])
@php($active_supervisee = $data['active_supervisee'])
@php($active_supervisor = $data['active_supervisor'])
@php($supervisees = $data['supervisees'])
@php($documentation = $data['documentation'])


@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 layout-spacing">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-3  layout-spacing">
                    <h2 class="">Project Supervisions</h2>
                </div>
                <div class="widget-content widget-content-area br-6">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                        <h3 class="">Project Supervisor</h3>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                        <form  method="post" action="">
                            <fieldset class="form-group border-round p-3 w-auto">
                                <legend class="badge badge-secondary text-left w-auto">Search Supervisor</legend>
                                <div class="">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                            <select id="selected_supervisory_group_id" class="form-control" name="supervisory_group_id">
                                                <option value="" >Choose Supervisor...</option>
                                                @foreach($supervisory_groups as $supervisory_group)
                                                <option value="{{$supervisory_group['sgid']}}"  @selected($supervisory_group['sgid']==$active_supervisor['id'])>{{$supervisory_group['supervisor']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                        <h3 class="">Supervisee Information</h3>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                        <form method="post" action="{{route('getsupervisoryinfo.coordination.project')}}">
                            <fieldset class="form-group border-round p-3 w-auto">
                                <legend class="badge badge-dark text-left w-auto">Search Supervisee</legend>
                                <div class="">
                                    @csrf
                                    <input type="hidden" id="this_sgid" name="this_sgid" value="{{$supervisory_group['sgid']}}">
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                            <select id="supervisor_supervisees" class="form-control" name="supervisee_id">
                                                <option value="" >Choose Supervisee...</option>
                                                @foreach($supervisees as $supervisee)
                                                <option value="{{$supervisee['supervisee_id']}}" @selected($supervisee['supervisee_id']==$active_supervisee['id'])>{{$supervisee['supervisee_regno']}} - {{$supervisee['supervisee_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 d-flex align-items-center">
                                            <button type="submit" class="btn btn-primary">Get Information</button>
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
                                        <td class="p-2">
                                            <h6 class="p-0 mb-0 font-weight-bolder text-monospace">Supervisor:</h6>
                                        </td>
                                        <td>
                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{$active_supervisor['name']}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2">
                                            <h6 class="p-0 mb-0 font-weight-bolder text-monospace">Supervisee:</h6>
                                        </td>
                                        <td>
                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{$active_supervisee['name']}} ({{$active_supervisee['regno']}})</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2">
                                            <h6 class="p-0 mb-0 font-weight-bolder text-monospace">Project Topic:</h6>
                                        </td>
                                        <td>
                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{$active_supervisee['topic']}}</h6>
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
        </div>
        <div class="row">
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
                                                                        <p>{{ucfirst($document['comment'])}}</a></p>
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
                                                                        <p>{{ucfirst($document['comment'])}}</a></p>
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
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
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
                                                                        <p>{{ucfirst($document['comment'])}}</a></p>
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
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3 badge badge-success">Documents Review</div>

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
                                                                        <p>{{ucfirst($document['comment'])}}</a></p>
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
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
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
                                    Chapter 3: Methodology  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
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
                                                            @foreach($documentation['chapter3']['documents'] as $document)
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
                                                                        <p>{{ucfirst($document['comment'])}}</a></p>
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
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3 badge badge-success">Documents Review</div>

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
                                                                        <p>{{ucfirst($document['comment'])}}</a></p>
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
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
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
                                    Chapter 4: Implementation and Discussion of Result  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
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
                                                                        <p>{{ucfirst($document['comment'])}}</a></p>
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
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3 badge badge-success">Documents Review</div>

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
                                                                        <p>{{ucfirst($document['comment'])}}</a></p>
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
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
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
                                    Chapter 5: Summary, Conclusion and Recommendations  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
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
                                                                        <p>{{ucfirst($document['comment'])}}</a></p>
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
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3 badge badge-success">Documents Review</div>

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
                                                                        <p>{{ucfirst($document['comment'])}}</a></p>
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
                                                                @endif                    
                                                            @endforeach
                                                        @else
                                                        <p class="p-3 text-danger">No uploads yet</p>
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
