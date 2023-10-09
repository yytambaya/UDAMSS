@extends('layouts.app')

@php($lecturers = $data['lecturers'])
@php($supervisory_groups = $data['supervisory_groups'])
@php($students = $data['students'])
@php($active_session = $data['active_session'])
@php($opened_submission = $data['opened_submission'])
@php($session = $data['session'])
@php($due_date = $data['due_date'])

@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-sm-12 col-12 layout-spacing">
                <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="submissions-tab" data-toggle="tab" href="#submissions" role="tab" aria-controls="submissions" aria-selected="false">Submissions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="supervisions-tab" data-toggle="tab" href="#supervisions" role="tab" aria-controls="supervisions" aria-selected="false">Supervisions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="setup-tab" data-toggle="tab" href="#setup" role="tab" aria-controls="setup" aria-selected="false">Setup</a>
                    </li>
                </ul>
                <div class="tab-content" id="simpletabContent">
                    
                    <div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <p class="mb-4">Dashboard</p> 
                    </div>
                    
                    <div class="tab-pane fade" id="submissions" role="tabpanel" aria-labelledby="submissions-tab">
                        <div class="row">
                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                                <div class="widget-content widget-content-area br-6">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-3">
                                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 mb-5">
                                            <h3 class="">Project Topics Submissions</h3>
                                        </div>
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">    
                                            <div class="row">    
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                                    <form method="post" action="{{route('project')}}">
                                                        @csrf
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-primary" type="submit">Approve By Group</button>
                                                            </div>
                                                            <select class="form-control form-control-sm" name="approve-group-submissions" required>
                                                                <option>--select group--</option>
                                                                <option>One</option>
                                                                <option>Two</option>
                                                                <option>Three</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-center">
                                                    <form method="post" action="{{route('project')}}">
                                                        @csrf
                                                        <input type="hidden" name="approve-all-submissions" value="{{''}}">
                                                        <div class="input-group mb-4">
                                                            <button type="submit" class="btn btn-danger">Approve All</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mb-4 mt-4">
                                        <table id="zero-config" class="table table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Topic</th>
                                                    <th>Group</th>
                                                    <th>Supervisor</th>
                                                    <th>Date</th>
                                                    <th class="no-content">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>1</td>
                                                    <td>Edinburgh</td>
                                                    <td>2011/04/25</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Garrett Winters</td>
                                                    <td>Accountant</td>
                                                    <td>3</td>
                                                    <td>Tokyo</td>
                                                    <td>2011/07/25</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Ashton Cox</td>
                                                    <td>Junior Technical Author</td>
                                                    <td>6</td>
                                                    <td>San Francisco</td>
                                                    <td>2009/01/12</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Cedric Kelly</td>
                                                    <td>Senior Javascript Developer</td>
                                                    <td>2</td>
                                                    <td>Edinburgh</td>
                                                    <td>2012/03/29</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Airi Satou</td>
                                                    <td>Accountant</td>
                                                    <td>3</td>
                                                    <td>Tokyo</td>
                                                    <td>2008/11/28</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Brielle Williamson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>1</td>
                                                    <td>New York</td>
                                                    <td>2012/12/02</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Herrod Chandler</td>
                                                    <td>Sales Assistant</td>
                                                    <td>9</td>
                                                    <td>San Francisco</td>
                                                    <td>2012/08/06</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rhona Davidson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>5</td>
                                                    <td>Tokyo</td>
                                                    <td>2010/10/14</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Colleen Hurst</td>
                                                    <td>Javascript Developer</td>
                                                    <td>9</td>
                                                    <td>San Francisco</td>
                                                    <td>2009/09/15</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sonya Frost</td>
                                                    <td>Software Engineer</td>
                                                    <td>3</td>
                                                    <td>Edinburgh</td>
                                                    <td>2008/12/13</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jena Gaines</td>
                                                    <td>Office Manager</td>
                                                    <td>0</td>
                                                    <td>London</td>
                                                    <td>2008/12/19</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Quinn Flynn</td>
                                                    <td>Support Lead</td>
                                                    <td>2</td>
                                                    <td>Edinburgh</td>
                                                    <td>2013/03/03</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Charde Marshall</td>
                                                    <td>Regional Director</td>
                                                    <td>6</td>
                                                    <td>San Francisco</td>
                                                    <td>2008/10/16</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Haley Kennedy</td>
                                                    <td>Senior Marketing Designer</td>
                                                    <td>3</td>
                                                    <td>London</td>
                                                    <td>2012/12/18</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tatyana Fitzpatrick</td>
                                                    <td>Regional Director</td>
                                                    <td>9</td>
                                                    <td>London</td>
                                                    <td>2010/03/17</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Michael Silva</td>
                                                    <td>Marketing Designer</td>
                                                    <td>6</td>
                                                    <td>London</td>
                                                    <td>2012/11/27</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Paul Byrd</td>
                                                    <td>Chief Financial Officer (CFO)</td>
                                                    <td>4</td>
                                                    <td>New York</td>
                                                    <td>2010/06/09</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gloria Little</td>
                                                    <td>Systems Administrator</td>
                                                    <td>9</td>
                                                    <td>New York</td>
                                                    <td>2009/04/10</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Bradley Greer</td>
                                                    <td>Software Engineer</td>
                                                    <td>1</td>
                                                    <td>London</td>
                                                    <td>2012/10/13</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Dai Rios</td>
                                                    <td>Personnel Lead</td>
                                                    <td>5</td>
                                                    <td>Edinburgh</td>
                                                    <td>2012/09/26</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jenette Caldwell</td>
                                                    <td>Development Lead</td>
                                                    <td>0</td>
                                                    <td>New York</td>
                                                    <td>2011/09/03</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Yuri Berry</td>
                                                    <td>Chief Marketing Officer (CMO)</td>
                                                    <td>0</td>
                                                    <td>New York</td>
                                                    <td>2009/06/25</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Caesar Vance</td>
                                                    <td>Pre-Sales Support</td>
                                                    <td>1</td>
                                                    <td>New York</td>
                                                    <td>2011/12/12</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Doris Wilder</td>
                                                    <td>Sales Assistant</td>
                                                    <td>3</td>
                                                    <td>Sidney</td>
                                                    <td>2010/09/20</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Angelica Ramos</td>
                                                    <td>Chief Executive Officer (CEO)</td>
                                                    <td>7</td>
                                                    <td>London</td>
                                                    <td>2009/10/09</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gavin Joyce</td>
                                                    <td>Developer</td>
                                                    <td>2</td>
                                                    <td>Edinburgh</td>
                                                    <td>2010/12/22</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jennifer Chang</td>
                                                    <td>Regional Director</td>
                                                    <td>8</td>
                                                    <td>Singapore</td>
                                                    <td>2010/11/14</td>
                                                    <td>
                                                        <form method="post" action="{{route('project')}}">
                                                            @csrf
                                                            <input type="hidden" name="supervisee_id" value="">
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Topic</th>
                                                    <th>Group</th>
                                                    <th>Supervisor</th>
                                                    <th>Date</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade active show" id="supervisions" role="tabpanel" aria-labelledby="supervisions-tab">
                        <div class="row">
                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12  layout-spacing">
                                <div class="widget-content widget-content-area br-6">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                                        <h3 class="">Project Supervisor</h3>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 p-0">
                                        <form id="get-supervisor-form" method="post" action="{{route('post.coordination.project')}}">
                                            <fieldset class="form-group border-round p-3 w-auto">
                                                <legend class="badge badge-secondary text-left w-auto">Search Supervisor</legend>
                                                <div class="">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <select id="selected_supervisory_group_id" class="form-control" name="supervisory_group_id">
                                                                <option value="">Choose Supervisor...</option>
                                                                @foreach($supervisory_groups as $supervisory_group)
                                                                <option value="{{$supervisory_group['sgid']}}" >{{$supervisory_group['supervisor']}}</option>
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
                                        <form id="get-supervisee-form" method="post" action="{{route('post.coordination.project')}}">
                                            <fieldset class="form-group border-round p-3 w-auto">
                                                <legend class="badge badge-dark text-left w-auto">Search Supervisee</legend>
                                                <div class="">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <select id="supervisor_supervisees" class="form-control" name="student_id">
                                                                <option value="">Choose Supervisor first...</option>
                                                                <option value="" >{{--$supervisory_group->supervisor->getFormattedName()--}}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 d-flex align-items-center">
                                                            <button form="get-supervisor-form" type="submit" class="btn btn-primary">Get Information</button>
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
                                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{--$supervisor->getFormattedName()--}}</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-2">
                                                            <h6 class="p-0 mb-0 font-weight-bolder text-monospace">Supervisee:</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{--$supervisee->getFullName()--}} ({{--$supervisee->getCapRegno()--}})</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-2">
                                                            <h6 class="p-0 mb-0 font-weight-bolder text-monospace">Project Topic:</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{--ucwords($project_topic)--}}</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-2">
                                                            <h6 class="p-0 mb-0 font-weight-bolder text-monospace">Progress:</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="p-0 mb-0 font-weight-plain text-monospace">{{--ucwords($project_topic)--}}</h6>
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

                    <div class="tab-pane fade" id="setup" role="tabpanel" aria-labelledby="setup-tab">
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
        </div>
    </div>

@endsection
