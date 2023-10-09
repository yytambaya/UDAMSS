<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Student;
use App\Models\Announcement;
use App\Models\SupervisoryGroup;
use App\Models\Supervisor;
use App\Models\Supervisee;
use App\Models\ProposedProjectTopic;
use App\Models\ProjectWorkActivity;
use Illuminate\Database\Query\Builder;
use Carbon\Carbon;

class ProjectWorkCoordinationController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // $pa = ProjectWorkActivity::create([
        //     'session' => config('global.session'),
        //     'duration' => strtotime('2/10/2023 22:30'),
        // ]);
        
        $user = $request->user();

        $supervisoryGroups = SupervisoryGroup::get()->all();
        $supervisory_groups = [];

        // supervisory groups (supervisors)
        foreach($supervisoryGroups as $supervisoryGroup){
            $sgid = $supervisoryGroup->id;
            $supervision_limit = $supervisoryGroup->supervision_limit;
            $supervisor = $supervisoryGroup->supervisor;
            $supervisor_name = ($supervisor)?$supervisor->getFormattedName():"NO SUPERVISOR";
            $supervisory_groups[] = [
                'sgid' => $sgid,
                'limit' => $supervision_limit,
                'supervisor' => $supervisor_name,
            ];
        }

        // project activity information and status
        $project_activity = ProjectWorkActivity::where('session', config('global.session'))->first();
        $p_a_status = ($project_activity->status=='active')? true:false;
        $p_a_s_status = ($project_activity->submission_status == 'opened')?true:false;
        $due_date = "";

        if( $p_a_s_status && $project_activity->duration <= time() ){
            $project_activity->update([
                'submission_status' => 'closed',
                'duration' => '',
            ]);
            $p_a_s_status = false;
        }
        $due_date = ($p_a_s_status)?
            date('D, M j, h:i A', $project_activity->duration):
            '';
        // dd($project_activity->duration,date('d-m-y H:i A',$project_activity->duration),time(),date('d-m-y H:i A'));
        
        $data = [
            'page_name' => 'project',    
            'session' => $project_activity->session,    
            'active_session' => $p_a_status,    
            'opened_submission' => $p_a_s_status,    
            'due_date' => $due_date,    
            'lecturers' => User::where('usertype','lecturer')
                ->get()
                ->map(function (User $user){
                    return $user;
                })->reject(function (User $user) {
                    return $user->isSupervisor();
                }),
            'supervisory_groups' => $supervisory_groups,
            'supervisory_group_supervisees' => $supervisory_groups,
            'students' => User::where('usertype','student')
                ->get()
                ->map(function (User $user){
                    return $user;
                })->reject(function (User $user) {
                    return $user->isSupervisee();
                }),
            'supervisees' => DB::table('users')
            ->select('users.id AS id', 'students.regno AS regno',DB::raw('concat(users.last_name,", ",users.middle_name," ",users.first_name) AS name'))
            ->join('students', 'students.user_id', 'users.id')
            ->join('supervisees', 'supervisees.student_id', 'users.id')
            ->leftJoin('supervisory_groups', 'supervisory_groups.id', 'supervisees.supervisory_group_id')
            ->whereNot(function (Builder $query) {
                $query->where('supervisory_groups.session', config('global.session'))
                        ->where('supervisees.student_id', 'users.id');
            })
            ->get(),
        ];
        
        return view('lecturer.project_coordination', compact('data'));

    }

    public function setup(Request $request)
    {
         
        $user = $request->user();

        $supervisoryGroups = SupervisoryGroup::get()->all();
        $supervisory_groups = [];

        // supervisory groups (supervisors)
        foreach($supervisoryGroups as $supervisoryGroup){
            $sgid = $supervisoryGroup->id;
            $supervision_limit = $supervisoryGroup->supervision_limit;
            $supervisor = $supervisoryGroup->supervisor;
            $supervisor_name = ($supervisor)?$supervisor->getFormattedName():"NO SUPERVISOR";
            $supervisory_groups[] = [
                'sgid' => $sgid,
                'limit' => $supervision_limit,
                'supervisor' => $supervisor_name,
            ];
        }

        // project activity information and status
        $project_activity = ProjectWorkActivity::where('session', config('global.session'))->first();
        $p_a_status = ($project_activity->status=='active')? true:false;
        $p_a_s_status = ($project_activity->submission_status == 'opened')?true:false;
        $due_date = "";

        if( $p_a_s_status && $project_activity->duration <= time() ){
            $project_activity->update([
                'submission_status' => 'closed',
                'duration' => '',
            ]);
            $p_a_s_status = false;
        }
        $due_date = ($p_a_s_status)?
            date('D, M j, h:i A', $project_activity->duration):
            '';
        
        $data = [
            'page_name' => 'project',    
            'session' => $project_activity->session,    
            'active_session' => $p_a_status,    
            'opened_submission' => $p_a_s_status,    
            'due_date' => $due_date,    
            'lecturers' => User::where('usertype','lecturer')
                ->get()
                ->map(function (User $user){
                    return $user;
                })->reject(function (User $user) {
                    return $user->isSupervisor();
                }),
            'supervisory_groups' => $supervisory_groups,
            'supervisory_group_supervisees' => $supervisory_groups,
            'students' => User::where('usertype','student')
                ->get()
                ->map(function (User $user){
                    return $user;
                })->reject(function (User $user) {
                    return $user->isSupervisee();
                }),
            'supervisees' => DB::table('users')
            ->select('users.id AS id', 'students.regno AS regno',DB::raw('concat(users.last_name,", ",users.middle_name," ",users.first_name) AS name'))
            ->join('students', 'students.user_id', 'users.id')
            ->join('supervisees', 'supervisees.student_id', 'users.id')
            ->leftJoin('supervisory_groups', 'supervisory_groups.id', 'supervisees.supervisory_group_id')
            ->whereNot(function (Builder $query) {
                $query->where('supervisory_groups.session', config('global.session'))
                        ->where('supervisees.student_id', 'users.id');
            })
            ->get(),
        ];
        
        return view('lecturer.project_coordination.setup', compact('data'));

    }

    public function submissions(Request $request)
    {
    
        // supervisory groups (supervisors)
        $supervisoryGroups = SupervisoryGroup::get()->all();
        $supervisory_groups = [];
         foreach($supervisoryGroups as $supervisoryGroup){
            $sgid = $supervisoryGroup->id;
            $supervision_limit = $supervisoryGroup->supervision_limit;
            $supervisor = $supervisoryGroup->supervisor;
            $supervisor_id = $supervisoryGroup->supervisor->id;
            $supervisor_name = ($supervisor)?$supervisor->getFormattedName():"NO SUPERVISOR";
            $supervisory_groups[] = [
                'sgid' => $sgid,
                'supervisor_id' => $supervisor_id,
                'limit' => $supervision_limit,
                'supervisor' => $supervisor_name,
            ];
        }

        // supervisees
        $supervisees = Supervisee::where('assignment_action', 'noaction')->get()->all();
        $supervisees = ($supervisees)?$supervisees:[];
        $submissions = [];
         foreach($supervisees as $supervisee){
            $id = $supervisee->id;
            $name = $supervisee->getFullName();
            $regno = $supervisee->getCapRegno();
            $sgid = $supervisee->supervisory_group_id;
            $supervisor_group = $supervisee->supervisory_group;
            $supervisor_group_supervisor = ($supervisor_group)?$supervisor_group->supervisor:"";
            $supervisor = ($supervisor_group_supervisor)?$supervisor_group_supervisor->getFormattedName():"NO SUPERVISORY GROUP!";
            $topic = ($supervisee->getProjectTopic())?$supervisee->getProjectTopic():'';
            $date = date('D, M j, h:i A', strtotime($supervisee->created_at));
            $submissions[] = [
                'id' => $id,
                'name' => $name,
                'regno' => $regno,
                'supervisor' => $supervisor,
                'topic' => $topic,
                'date' => $date,
            ];
        }

        $data = [
            'page_name' => 'project',    
            'supervisory_groups' => $supervisory_groups,
            'submissions' => $submissions,
        ];

        return view('lecturer.project_coordination.submissions', compact('data'));

    }

    public function approveSubmission(Request $request)
    {
        
        $validatedData = $request->validate([
            'supervisee_id' => 'required',
        ]);

        $supervisee_id = $validatedData['supervisee_id'];
        $supervisee = Supervisee::where('id', $supervisee_id)
        ->update([
            'assignment_action' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Submission approved successfully!');

    }

    public function approveGroupSubmissions(Request $request)
    {
                        
        $validatedData = $request->validate([
            'supervisory_group_id' => 'required',
        ]);
        
        $supervisory_group_id = $validatedData['supervisory_group_id'];
        $supervisee = Supervisee::where('supervisory_group_id', $supervisory_group_id)
        ->update([
            'assignment_action' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Submissions approved successfully!');

    }

    public function approveAllSubmissions(Request $request)
    {
        
        $supervisee = Supervisee::where([
            ['assignment_action', 'noaction'],
            ['session', config('global.session')],
        ])
        ->update([
            'assignment_action' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Submissions approved successfully!');

    }
    
    public function supervision(Request $request)
    {
        
        $user = $request->user();

        $supervisoryGroups = SupervisoryGroup::get()->all();
        $supervisory_groups = [];
        $active_supervisor = [
            'id' => '',
            'name' => '',
        ];
        // active supervises
        $active_supervisee = [
            'id' => '',
            'name' => '',
            'regno' => '',
            'topic' => '',
            'progress' => 0,
        ];

        // supervisory groups (supervisors)
        foreach($supervisoryGroups as $supervisoryGroup){
            $sgid = $supervisoryGroup->id;
            $supervision_limit = $supervisoryGroup->supervision_limit;
            $supervisor = $supervisoryGroup->supervisor;
            $supervisor_id = $supervisoryGroup->supervisor->id;
            $supervisor_name = ($supervisor)?$supervisor->getFormattedName():"NO SUPERVISOR";
            $supervisory_groups[] = [
                'sgid' => $sgid,
                'supervisor_id' => $supervisor_id,
                'limit' => $supervision_limit,
                'supervisor' => $supervisor_name,
            ];
        }
       
        $data = [
            'page_name' => 'project',    
            'supervisory_groups' => $supervisory_groups,
            'supervisees' => [],
            'active_supervisor' => $active_supervisor,
            'active_supervisee' => $active_supervisee,
            'documentation' => [],
        ];

        return view('lecturer.project_coordination.supervisions', compact('data'));

    }
    
    public function getSupervisoryInfo(Request $request)
    {
        
        $user = $request->user();

        $validatedData = $request->validate([
            'supervisee_id' => 'required|numeric',
        ]);

        $supervisee_id = $validatedData['supervisee_id'];

        $this_supervisee = Supervisee::where([
            ['id', $supervisee_id],
            ['assignment_action', 'approved'],
        ])->first();

        $thisSupervisoryGroup = $this_supervisee->supervisory_group;
        $svrid = $thisSupervisoryGroup->id;
    
        $supervisoryGroups = SupervisoryGroup::where([
            ['session', config('global.session')],
            ['supervision_type', 'project'],
        ])->get()->all();
        $supervisory_groups = [];
        $active_supervisor = [
            'id' => '',
            'name' => '',
        ];
        // active supervises
        $active_supervisee = [
            'id' => '',
            'name' => '',
            'regno' => '',
            'topic' => '',
            'progress' => 0,
        ];

        // supervisee
        $get_this_supervisee = Supervisee::where([
            ['id', $supervisee_id ],
            ['session', config('global.session')],
            ])->first();
        
        $this_supervisee = ($get_this_supervisee)?$get_this_supervisee:[];
        $this_documentations =($this_supervisee && $this_supervisee->project_documentation)?
            $this_supervisee->project_documentation->where('session', config('global.session'))->all():[];
        
        $documentations['progress'] = 0;
        $chapter_status = [];
        foreach($this_documentations as $this_documentation){
            $id = $this_documentation->id;
            $chapter_no = $this_documentation->chapter_no;
            $supervisee_id = $this_documentation->supervisee_id;
            $key = "chapter$chapter_no";
            $comment = $this_documentation->comment;
            $version = $this_documentation->version;
            $status = $this_documentation->status;
            $type = $this_documentation->type;
            $date = Carbon::createFromDate($this_documentation->created_at)->format('D, M j, h:i A');
            $documentations[$key]['documents'][] = [
                'id' => $id,
                'chapter_no' => $chapter_no,
                'supervisee_id' => $supervisee_id,
                'version' => $version,
                'type' => $type,
                'status' => $status,
                'comment' => $comment,
                'date' => $date,
            ];

            if( !array_key_exists($chapter_no, $chapter_status )){
                $chapter_status[$chapter_no] = $status;
            }
            else{
                if( $status == 'approved')
                    $chapter_status[$chapter_no] = $status;
            }

            $documentations[$key]['status'] = $chapter_status[$chapter_no];
            $documentations['progress'] = (20 * count($chapter_status));
                
        }
        
        // supervisory groups (supervisors)
        foreach($supervisoryGroups as $supervisoryGroup){
            $sgid = $supervisoryGroup->id;
            $supervision_limit = $supervisoryGroup->supervision_limit;
            $supervisor = $supervisoryGroup->supervisor;
            $supervisor_id = $supervisoryGroup->supervisor->id;
            $supervisor_name = ($supervisor)?$supervisor->getFormattedName():"NO SUPERVISOR";
            $supervisory_groups[] = [
                'sgid' => $sgid,
                'supervisor_id' => $supervisor_id,
                'limit' => $supervision_limit,
                'supervisor' => $supervisor_name,
            ];

            // active supervisor
            if($sgid == $svrid ){
                $active_supervisor = [
                    'id' => $sgid,
                    'name' => $supervisor_name,
                ];
            }
        }

        // supervisees
        $supervisees = [];
        foreach($thisSupervisoryGroup->supervisee as $supervisoryGroupSupervisee){
            $id = $supervisoryGroupSupervisee->id;
            $name = $supervisoryGroupSupervisee->getFullName();
            $regno = $supervisoryGroupSupervisee->getCapRegno();
            $topic = $supervisoryGroupSupervisee->getProjectTopic();
            $supervisees[] = [
                'supervisee_id' => $id,
                'supervisee_name' => $name,
                'supervisee_regno' => $regno,
                'supervisee_topic' => $topic,
            ];

            // active supervisee
            if($supervisee_id == $id ){
                $active_supervisee = [
                    'id' => $id,
                    'name' => $name,
                    'regno' => $regno,
                    'topic' => $topic,
                    'progress' => 20,
                ];
            }
        }
        
        $data = [
            'page_name' => 'project',    
            'supervisory_groups' => $supervisory_groups,
            'supervisees' => $supervisees,
            'active_supervisor' => $active_supervisor,
            'active_supervisee' => $active_supervisee,
            'documentation' => $documentations,
        ];

        return view('lecturer.project_coordination.supervisions', compact('data'));

    }

    /**
     * Ajax.
     *
     * @return void
     */
    public function getSupervisorSupervisees(Request $request)
    {
        $validatedData = $request->validate([
            'current_supervisory_group_id' => 'required|numeric',
        ]);
                
        $supervisory_group_id = $validatedData['current_supervisory_group_id'];
        $supervisoryGroup = SupervisoryGroup::where('id', $supervisory_group_id)->first();
        $sg_supervisees = ($supervisoryGroup->supervisee)?
            $supervisoryGroup->supervisee->where('assignment_action', 'approved'):[];
            
        $supervisees = "";

        // assignable students
        foreach($sg_supervisees as $sg_supervisee){
            $id = $sg_supervisee->id;
            $name = $sg_supervisee->getFullName();
            $regno = $sg_supervisee->getCapRegno();
            $supervisees .= "<option value=".'"'.$id.'">'."$regno - $name"."</option>";
        }

        $supervisees = ($supervisees)?$supervisees:'<option value="">No Students Assigned Yet!</option>';
        
        return response()->json($supervisees);

    }
    
    /**
     * 
     *
     * @return void
     */
    public function createSupervisoryGroup(Request $request)
    {
        $validatedData = $request->validate([
            'supervisor_id' => 'sometimes|required',
            'supervision_limit' => 'required',
            'session' => 'sometimes|required|unique:supervisory_groups',
        ]);
        
        $validatedData['session'] = config('global.session');
        $validatedData['lecturer_id'] = $validatedData['supervisor_id'];

        $supervisoryGroup = SupervisoryGroup::create($validatedData);
        $supervisor = Supervisor::create($validatedData);

        return redirect()->back()->with('success', 'Supervisory Group Created Successfully.');
    }

    /**
     * 
     *
     * @return void
     */
    private function isSupervisionLimitReached(int $supervisory_group_id): bool
    {
        // check for supervisee limit
        $supervisory_group = SupervisoryGroup::where('id', $supervisory_group_id)->first();
        $assigned_supervisees_count = $supervisory_group->supervisee->count();

        return $assigned_supervisees_count >= $supervisory_group->supervision_limit;
    }

    /**
     * .
     *
     * @return void
     */
    public function assignSupervisee(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|numeric',
            'supervisory_group_id' => 'required|numeric',
            'topic_1' => 'required',
            'topic_2' => 'required',
            'topic_3' => 'required',
        ]);

        if( $this->isSupervisionLimitReached($validatedData['supervisory_group_id'])){
            return redirect()->back()->withInput()->with('max_supervision_limit', 'Maximun number of students reached!');
        }
        else{
            $validatedData['session'] = config('global.session');        
            $validatedData['assignment_type'] = 'manual';        
            $validatedData['assignment_action'] = 'approved';

            $supervisee = Supervisee::create($validatedData);
            $topics = ProposedProjectTopic::create($validatedData);
        }

        return redirect()->back()->with('success', 'Student Assigned Successfully.');
    }

    /**
     * .
     *
     * @return void
     */
    public function reassignSupervisee(Request $request)
    {
        
        $validatedData = $request->validate([
            'student_id' => 'required|numeric',
            'new_supervisory_group_id' => 'required|numeric',
        ]);
        
        if( $this->isSupervisionLimitReached($validatedData['new_supervisory_group_id'])){
            return redirect()->back()->withInput()->with('max_supervision_limit', 'Maximun number of students reached!');
        }
        else{
            $supervisee = Supervisee::where('student_id', $validatedData['student_id'])->first();      
            $supervisee->update(['supervisory_group_id'=> $validatedData['new_supervisory_group_id']]);
        }

        return redirect()->back()->with('reassign_success', 'Student Reassigned Successfully!');
    }

    /**
     * Ajax.
     *
     * @return void
     */
    public function getReassignSupervisee(Request $request)
    {
        $validatedData = $request->validate([
            'current_supervisory_group_id' => 'required|numeric',
        ]);
        
        $supervisory_group_id = $validatedData['current_supervisory_group_id'];
        $supervisoryGroup = SupervisoryGroup::where('id', $supervisory_group_id)->first();
        $supervisor_id = $supervisoryGroup->supervisor_id;
        $reassignable_supervisees = ($supervisoryGroup->supervisee)?
            $supervisoryGroup->supervisee->where('assignment_action', 'approved'):[];
        $new_supervisorsory_groups = SupervisoryGroup::whereNot('id', $supervisory_group_id)->get();
            
        $supervisors = "";
        $supervisees = "";

        // new supervisors
        foreach($new_supervisorsory_groups as $new_supervisorsory_group){
            $supervisor = $new_supervisorsory_group->supervisor;
            $supervisor_name = ($supervisor)?$supervisor->getFormattedName():"NO SUPERVISOR";
            $supervisors .= "<option value=".'"'.$new_supervisorsory_group->id.'">'.$supervisor_name."</option>";
        }

        // assignable students
        foreach($reassignable_supervisees as $reassignable_supervisee){
            $name = $reassignable_supervisee->getFullName();
            $regno = $reassignable_supervisee->getCapRegno();
            $supervisees .= "<option value=".'"'.$reassignable_supervisee->student_id.'">'."$regno - $name"."</option>";
        }
        $supervisees = ($supervisees)?$supervisees:'<option value="">No Students Assigned Yet!</option>';
        
        return response()->json([$supervisors, $supervisees]);

    }

    /**
     * .
     *
     * @return void
     */
    public function openSubmission(Request $request)
    {
        $validatedData = $request->validate([
            'deadline_date' => 'required|date|after_or_equal:today',
            'deadline_time' => 'required',
        ]);

        $date = $validatedData['deadline_date'];
        $time = $validatedData['deadline_time'];
        $duration = strtotime("$date, $time");

        
        if($duration <= time()){
            return redirect()->back()->withInput()->with('error', 'Deadline must be a time in future!');
        }

        $project_activity = ProjectWorkActivity::where([
            ['session', config('global.session')],
            ['status', 'active'],
            ])->first();
            
        if($project_activity->submission_status == 'opened'){
            return redirect()->back()->withInput()->with('warning', 'Submission already opened!');
        }

        $project_activity->update([
            'submission_status' => 'opened',
            'duration' => $duration,
        ]);
        
        return redirect()->back()->with('success', 'Submission opened successfully!');

    }


    /**
     * .
     *
     * @return void
     */
    public function closeSubmission(Request $request)
    {
        
        
        if( !($request->user()->isProjectCoordinator()) ){
            return redirect()->back()->withInput()->with('error', 'Unauthorized action!');
        }

        $project_activity = ProjectWorkActivity::where([
            ['session', config('global.session')],
            ['status', 'active'],
        ])->first();
            
        if($project_activity->submission_status == 'closed'){
            return redirect()->back()->withInput()->with('warning', 'Submission already closed!');
        }

        $project_activity->update([
            'submission_status' => 'closed',
            'duration' => '',
        ]);
        
        return redirect()->back()->with('success', 'Submission closed successfully!');
    }


    
}
