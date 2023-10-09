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
use App\Models\SupervisoryInteraction;
use App\Models\ProjectDocumentation;
use Illuminate\Database\Query\Builder;
use Carbon\Carbon;


class ProjectWorkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * 
     *
     * @return void
     */
    public function index(Request $request)
    {
        
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
     * 
     *
     * @return void
     */
    public function submission(Request $request)
    {
        
        $user = $request->user();
        
        $supervisee = [
            'name' => $user->getFullName(),
            'regno' => $user->student->getCapRegno(),
            'hasSubmission' => false,
        ];
        $submission = ['hasTopic' => false,];
        $supervisor = [];

        // supervisee
        $this_supervisee = ($user->supervisee->where('session', config('global.session'))->first())?
            $user->supervisee->where('session', config('global.session'))->first():[];
        if($this_supervisee){
            $supervisee['hasSubmission'] = true;
            $supervisee['isApprovedSubmission'] = ($this_supervisee->assignment_action == 'approved');

            // project information
            $this_supervisory_group = ($this_supervisee->supervisory_group)?
                $this_supervisee->supervisory_group:[];
            $this_supervisor = ($this_supervisory_group->supervisor)?$this_supervisory_group->supervisor:[];
            $this_supervisor = [
                'name' => $this_supervisor->getFormattedName(),
                'sgid' => $this_supervisory_group->id,
            ];


            $this_submission = ($this_supervisee->proposed_project_topic)?
                $this_supervisee->proposed_project_topic->where('session', config('global.session'))->first():[];

            if($this_submission){
                $submission = [
                    'hasTopic' => true,
                    'topic1' => $this_submission->topic_1,
                    'topic2' => $this_submission->topic_2,
                    'topic3' => $this_submission->topic_3,
                    'approvedTopic' => $this_submission->approved_topic,
                ];
            }
        }
        
        // supervisory groups (supervisors)
        
        $supervisory_groups = [];
        if ($supervisee['isApprovedSubmission'] == false) {
            $supervisoryGroups = SupervisoryGroup::get()->all();
            foreach($supervisoryGroups as $supervisoryGroup){
                $sgid = $supervisoryGroup->id;
                $supervision_limit = $supervisoryGroup->supervision_limit;
                $supervisor = $supervisoryGroup->supervisor;
                $supervisor_name = ($supervisor)?$supervisor->getFormattedName():"NO SUPERVISOR";
                $supervisory_groups[] = [
                    'sgid' => $sgid,
                    'limit' => $supervision_limit,
                    'supervisor' => $supervisor_name,
                    'isFull' => $this->isSupervisionLimitReached($sgid),
                ];
            }
        }

        // project activity status
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
            date('D, M j, h:i A', $project_activity->duration):'';
        
        $data = [
            'page_name' => 'project',    
            'session' => $project_activity->session,    
            'opened_submission' => $p_a_s_status,    
            'due_date' => $due_date,    
            'supervisee' => $supervisee,    
            'supervisor' => $this_supervisor,    
            'submission' => $submission,    
            'supervisory_groups' => $supervisory_groups,
        ];

        // dd($data);

        return view('student.project.submission', compact('data'));
    }

     /**
     *
     *
     * @return void
     */
    public function submit(Request $request)
    {

        $user = $request->user();

        $validatedData = $request->validate([
            'supervisory_group_id' => 'required|numeric',
            'topic_1' => 'required',
            'topic_2' => 'required',
            'topic_3' => 'required',
        ]);

        
        if( $this->isSupervisionLimitReached($validatedData['supervisory_group_id'])){
            return redirect()->back()->withInput()->with('error', 'Maximun number of students reached!');
        }
        else{
            $validatedData['student_id'] = $user->id;
            $validatedData['session'] = config('global.session');        

            // $supervisee = Supervisee::create($validatedData);
            $topics = ProposedProjectTopic::create($validatedData);
        }

        return redirect()->back()->with('success', 'Information submitted successfully!');
       
    }

    /**
     *
     *
     * @return void
     */
    public function updateSubmission(Request $request)
    {
        $user = $request->user();

        $validatedData = $request->validate([
            'supervisory_group_id' => 'required|numeric',
            'topic_1' => 'required',
            'topic_2' => 'required',
            'topic_3' => 'required',
        ]);

        $supervisee = $user->supervisee->where('session', config('global.session'))->first();
        $topics = $supervisee->proposed_project_topic->where('session', config('global.session'))->first();
        
        $affected_rows_s = $supervisee->update($validatedData);
        $affected_rows_t = $topics->update($validatedData);

        return redirect()->back()->with('success', 'Submission updated successfully!');  
       
    }

    /**
     * 
     *
     * @return void
     */
    public function interaction(Request $request)
    {
        
        $user = $request->user();

        $supervisee = [
            'name' => $user->getFullName(),
            'regno' => $user->student->getCapRegno(),
            'hasSubmission' => false,
        ];
        $submission = ['hasTopic' => false,];

        // supervisee
        $this_supervisee = ($user->supervisee->where('session', config('global.session'))->first())?
            $user->supervisee->where('session', config('global.session'))->first():[];

        // supervisor
        $this_supervisor = $this_supervisee->getSupervisor();
        $supervisor = ($this_supervisor)?$this_supervisor->getFormattedName():'NO SUPERVISOR';

        // supervisory group
        $this_supervisory_group = ($this_supervisee->supervisory_group)?
            $this_supervisee->supervisory_group:[];
        $sgid = ($this_supervisory_group)?$this_supervisory_group->id:'';
    
        // supervisees
        $sg_supervisees = ($this_supervisory_group)?$this_supervisory_group->supervisee:[];
        $supervisees = [];
        foreach($sg_supervisees as $sg_supervisee){
            $id = $sg_supervisee->id;
            $name = $sg_supervisee->getFullName();
            $regno = $sg_supervisee->getCapRegno();
            $supervisees[] = [
                'id' => $id,
                'name' => $name,
                'regno' => $regno,
            ];
        }
       
        // interactions
        $sg_interactions = ($this_supervisory_group)?
            $this_supervisory_group->supervisory_interaction->where('status', 'active')->sortByDesc('created_at'):[];
        $interactions = [];
         foreach($sg_interactions as $sg_interaction){
            $id = $sg_interaction->id;
            $date = $sg_interaction->getPostedDate();
            $content = ucfirst($sg_interaction->getContent());
            $isSupervisor = $sg_interaction->isSupervisor();
            $isPostAuthor = $sg_interaction->isPostAuthor($user->id);
            $postAuthor = $sg_interaction->getAuthor();
            $author = $postAuthor->getFormattedName();
            $regno = ($postAuthor->isStudent())?$postAuthor->student->getCapRegno():'';
            $interactions[] = [
                'id' => $id,
                'date' => $date,
                'regno' => $regno,
                'author' => $author,
                'content' => $content,
                'isSupervisor' => $isSupervisor,
                'isPostAuthor' => $isPostAuthor,
            ];
        }
        
        $data = [
            'page_name' => 'project',
            'sgid' => $sgid,
            'supervisor' => $supervisor,
            'supervisee' => $supervisee,
            'supervisees' => $supervisees,
            'interactions' => $interactions,
        ];

        return view('student.project.interaction', compact('data'));
    }

     /**
     *
     *
     * @return void
     */
    public function postInteractionMessage(Request $request)
    {

        $user = $request->user();

        $validatedData = $request->validate([
            'supervisory_group_id' => 'required|numeric',
            'content' => 'required',
        ]);

        $validatedData['user_id'] = $user->id;
        $validatedData['publicity'] = 'public';

        $supervision_interaction = SupervisoryInteraction::create($validatedData);

        return redirect()->back()->with('success', 'Message posted successfully!');
       
    }
    
    /**
     *
     *
     * @return void
     */
    public function editInteractionMessage(Request $request)
    {

        $user = $request->user();

        $validatedData = $request->validate([
            'message_id' => 'required|numeric',
            'content' => 'required',
        ]);

        $message_id = $validatedData['message_id'];
        $supervision_interaction = SupervisoryInteraction::where('id', $message_id)->first();
        $affected_rows = $supervision_interaction->update($validatedData);

        if ( $affected_rows )
            return redirect()->back()->with('success', 'Message updated successfully!');

        return redirect()->back()->with('warning', 'Failed to update message!');       
    }

    /**
     *
     *
     * @return void
     */
    public function deleteInteractionMessage(Request $request)
    {

        $user = $request->user();

        $validatedData = $request->validate([
            'message_id' => 'required|numeric',
        ]);

        $message_id = $validatedData['message_id'];
        $supervision_interaction = SupervisoryInteraction::where('id', $message_id)->first();
        $affected_rows = $supervision_interaction->update(['status' => 'deleted']);

        if ( $affected_rows )
            return redirect()->back()->with('success', 'Message updated successfully!');

        return redirect()->back()->with('warning', 'Failed to update message!'); 
       
    }
    
    /**
     * 
     *
     * @return void
     */
    public function workspace(Request $request)
    {
        
        $user = $request->user();
        
        // supervisee
        $this_supervisee = ($user->supervisee->where('session', config('global.session'))->first())?
            $user->supervisee->where('session', config('global.session'))->first():[];
        $supervisee = [
            'name' => $user->getFullName(),
            'regno' => $user->student->getCapRegno(),
            'topic' => ($this_supervisee)?$this_supervisee->getProjectTopic():'NO TOPIC',
        ];

        // supervisor
        $this_supervisor = $this_supervisee->getSupervisor();
        $supervisor = ($this_supervisor)?$this_supervisor->getFormattedName():'NO SUPERVISOR';
        
        // project documentation
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
        
        // dd($documentations, $chapter_status);

        $data = [
            'page_name' => 'project',
            'supervisee' => $supervisee,
            'supervisor' => $supervisor,
            'documentation' => $documentations,
            
        ];

        return view('student.project.workspace', compact('data'));
    }

    /**
     *
     *
     * @return void
     */
    public function uploadDocument(Request $request)
    {

        $user = $request->user();

        $validatedData = $request->validate([
            'chapter_no' => 'required|numeric',
            'document' => 'required',
            'comment' => 'sometimes',
        ]);

        $supervisee_id = $user->supervisee->where('session', config('global.session'))->first()->id;
        $chapter_no = $validatedData['chapter_no'];

        // count number of uploads for this chapter
        $count = ProjectDocumentation::where([
            ['supervisee_id', $supervisee_id],
            ['chapter_no', $chapter_no],
            ])->count();
        // next upload title
        $next = $count + 1;

        $fileName = "upload_${supervisee_id}_${chapter_no}.$next." . $validatedData['document']->extension();
        $validatedData['version'] = $next;
        $validatedData['supervisee_id'] = $supervisee_id;
        $validatedData['filename'] = $fileName;
        $validatedData['session'] = config('global.session');
        $validatedData['document']->storeAs('public/documentation', $fileName);

        // dd($validatedData);

        $projectDocumentation = ProjectDocumentation::create($validatedData);

        return redirect()->back()->with('success', 'Document uploaded successfully!');
       
    }


}
