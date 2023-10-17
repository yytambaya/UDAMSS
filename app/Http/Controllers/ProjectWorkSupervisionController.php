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
use App\Models\SupervisoryInteraction;
use App\Models\ProjectWorkActivity;
use App\Models\ProjectDocumentation;
use Illuminate\Database\Query\Builder;
use Carbon\Carbon;
use Closure;


class ProjectWorkSupervisionController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function (Request $request, Closure $next) {
            if( $request->user()->isLecturer() )
                return $next($request);
            return abort(403);
        });

    }

    /**
     *
     *
     * @return void
     */
    public function students(Request $request)
    {
        $user = $request->user();

        $supervisory_group = SupervisoryGroup::where([
            ['supervisor_id', $user->id],
            ['supervision_type', 'project'],
            ['session', config('global.session')],
        ])->first();

        $sg_supervisor = ($supervisory_group->supervisor)?
            $supervisory_group->supervisor:'';
                    
        $supervisor['name'] = ($sg_supervisor->getFormattedName())?
            $sg_supervisor->getFormattedName():'';
        $supervisor['sgid'] = $supervisory_group->id;

        $sg_supervisees = ($supervisory_group->supervisee)?
            $supervisory_group->supervisee->where('assignment_action', 'approved'):[];

        // supervisees
        $supervisees = [];
        foreach($sg_supervisees as $sg_supervisee){
            $id = $sg_supervisee->id;
            $name = $sg_supervisee->getFullName();
            $regno = $sg_supervisee->getCapRegno();
            $topic = ($sg_supervisee->getProjectTopic())?$sg_supervisee->getProjectTopic():'';
            $date = date('D, M j, h:i A', strtotime($sg_supervisee->created_at));

            $this_supervisee = ($sg_supervisee)?$sg_supervisee:[];
                $this_documentations =($this_supervisee && $this_supervisee->project_documentation)?
            $this_supervisee->project_documentation->where('session', config('global.session'))->all():[];
        
            $documentations['progress'] = 0;
            $chapter_status = [];
            foreach($this_documentations as $this_documentation){
                $sgid = $this_documentation->id;
                $chapter_no = $this_documentation->chapter_no;
                $supervisee_id = $this_documentation->supervisee_id;
                $key = "chapter$chapter_no";
                $comment = $this_documentation->comment;
                $version = $this_documentation->version;
                $status = $this_documentation->status;
                $type = $this_documentation->type;
                $date = Carbon::createFromDate($this_documentation->created_at)->format('D, M j, h:i A');
                $documentations[$key]['documents'][] = [
                    'id' => $sgid,
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
                    if( $status == 'approved')
                        $chapter_status['approved'][] = $chapter_no;
                }
                else{
                    if( $status == 'approved'){
                        $chapter_status[$chapter_no] = $status;
                        $chapter_status['approved'][] = $chapter_no;
                    }
                }

                $documentations[$key]['status'] = $chapter_status[$chapter_no];
                $documentations['progress'] = (20 * count(isset($chapter_status['approved'])?$chapter_status['approved']:[]));
                    
            }

            
            $supervisees[] = [
                'id' => $id,
                'name' => $name,
                'regno' => $regno,
                'topic' => $topic,
                'date' => $date,
                'progress' => $documentations['progress'],
            ];
        }

        $data = [
            'page_name' => 'project',
            'supervisor' => $supervisor,
            'supervisees' => $supervisees,
        ];

        return view('lecturer.project_supervision.students', compact('data'));
       
    }

    /**
     *
     *
     * @return void
     */
    public function interaction(Request $request)
    {

        $user = $request->user();

        $supervisoryGroup = SupervisoryGroup::where([
            ['supervisor_id', $user->id],
            ['supervision_type', 'project'],
            ['session', config('global.session')],
        ])->first();

        // supervisor
        $supervisory_group = [];
        $sgid = $supervisoryGroup->id;
        $supervision_limit = $supervisoryGroup->supervision_limit;
        $supervisor = $supervisoryGroup->supervisor;
        $supervisor_id = $supervisoryGroup->supervisor->id;
        $user_id = $supervisoryGroup->supervisor->lecturer_id;
        $supervisor_name = ($supervisor)?$supervisor->getFormattedName():"NO SUPERVISOR";
        $supervisory_group = [
            'sgid' => $sgid,
            'user_id' => $user_id,
            'supervisor_id' => $supervisor_id,
            'limit' => $supervision_limit,
            'supervisor' => $supervisor_name,
        ];

        // supervisees
        $sg_supervisees = ($supervisoryGroup->supervisee)?
            $supervisoryGroup->supervisee->where('assignment_action', 'approved'):[];
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
        $sg_interactions = ($supervisoryGroup)?
            $supervisoryGroup->supervisory_interaction->where('status', 'active')->sortByDesc('created_at'):[];
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
            'publicityLabel' => $supervisory_group['supervisor'],
            'supervisory_group' => $supervisory_group,
            'supervisees' => $supervisees,
            'interactions' => $interactions,
        ];

        return view('lecturer.project_supervision.interaction', compact('data'));
       
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

        $supervisoryGroup = SupervisoryGroup::where([
            ['supervisor_id', $user->id],
            ['supervision_type', 'project'],
            ['session', config('global.session')],
        ])->first();

        // supervisor
        $supervisory_group = [];
        $sgid = $supervisoryGroup->id;
        $supervision_limit = $supervisoryGroup->supervision_limit;
        $supervisor = $supervisoryGroup->supervisor;
        $supervisor_id = $supervisoryGroup->supervisor->id;
        $user_id = $supervisoryGroup->supervisor->lecturer_id;
        $supervisor_name = ($supervisor)?$supervisor->getFormattedName():"NO SUPERVISOR";
        $supervisory_group = [
            'id' => $sgid,
            'user_id' => $user_id,
            'supervisor_id' => $supervisor_id,
            'limit' => $supervision_limit,
            'supervisor' => $supervisor_name,
        ];

        // supervisess
        $sg_supervisees = ($supervisoryGroup->supervisee)?
            $supervisoryGroup->supervisee->where('assignment_action', 'approved'):[];
        $supervisees = [];
         foreach($sg_supervisees as $sg_supervisee){
            $id = $sg_supervisee->id;
            $user_id = $sg_supervisee->student_id;
            $name = $sg_supervisee->getFullName();
            $regno = $sg_supervisee->getCapRegno();
            $supervisees[] = [
                'id' => $id,
                'name' => $name,
                'regno' => $regno,
                'isActive' => false,
            ];
        }

        $active_supervisee = [
            'id' => '',
            'name' => '',
            'regno' => '',
            'topic' => '',
            'progress' => '',
        ];

        $data = [
            'page_name' => 'project',
            'supervisees' => $supervisees,
            'active_supervisee' => $active_supervisee,
            'supervisory_group' => $supervisory_group,
            'documentation' => [],
        ];

        return view('lecturer.project_supervision.workspace', compact('data'));
       
    }
   
    /**
     *
     *
     * @return void
     */
    public function postWorkspace(Request $request)
    {
        
        $validatedData = $request->validate([
            'supervisory_group_id' => 'required|numeric',
            'supervisee_id' => 'required|numeric',
        ]);
        
        $sgid = $validatedData['supervisory_group_id'];
        $supervisee_id = $validatedData['supervisee_id'];
        
        $supervisoryGroup = SupervisoryGroup::where('id', $sgid)->get()->first();

        // supervisor
        $supervisory_group = [];
        $sgid = $supervisoryGroup->id;
        $supervision_limit = $supervisoryGroup->supervision_limit;
        $supervisor = $supervisoryGroup->supervisor;
        $supervisor_id = $supervisoryGroup->supervisor->id;
        $user_id = $supervisoryGroup->supervisor->lecturer_id;
        $supervisor_name = ($supervisor)?$supervisor->getFormattedName():"NO SUPERVISOR";
        $supervisory_group = [
            'id' => $sgid,
            'user_id' => $user_id,
            'supervisor_id' => $supervisor_id,
            'limit' => $supervision_limit,
            'supervisor' => $supervisor_name,
        ];

        // active supervises
        $active_supervisee = [
            'id' => '',
            'name' => '',
            'regno' => '',
            'topic' => '',
            'progress' => 0,
        ];
        
        // supervisess
        $sg_supervisees = ($supervisoryGroup->supervisee)?
            $supervisoryGroup->supervisee->where('assignment_action', 'approved'):[];
        $supervisees = [];
        foreach($sg_supervisees as $sg_supervisee){
            $id = $sg_supervisee->id;
            $user_id = $sg_supervisee->student_id;
            $name = $sg_supervisee->getFullName();
            $regno = $sg_supervisee->getCapRegno();
            $topic = ($sg_supervisee->getProjectTopic())?$sg_supervisee->getProjectTopic():'';
            $supervisees[] = [
                'id' => $id,
                'name' => $name,
                'regno' => $regno,
                'topic' => $topic,
                'isActive' => $supervisee_id == $id,
            ];
            if( $supervisee_id == $id ){
                $active_supervisee = [
                    'id' => $id,
                    'name' => $name,
                    'regno' => $regno,
                    'topic' => $topic,
                ];
            }
        }

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
                if( $status == 'approved')
                    $chapter_status['approved'][] = $chapter_no;
            }
            else{
                if( $status == 'approved'){
                    $chapter_status[$chapter_no] = $status;
                    $chapter_status['approved'][] = $chapter_no;
                }
            }

            $documentations[$key]['status'] = $chapter_status[$chapter_no];
            $documentations['progress'] = (20 * count(isset($chapter_status['approved'])?$chapter_status['approved']:[]));
                
        }

        $data = [
            'page_name' => 'project',
            'supervisees' => $supervisees,
            'active_supervisee' => $active_supervisee,
            'supervisory_group' => $supervisory_group,
            'documentation' => $documentations,
        ];

        
        // dd($data);
        return view('lecturer.project_supervision.workspace', compact('data'));
        
        // $regno = strtolower($active_supervisee['regno']);
        // return redirect( "project/supervision/workspace/$regno")->with($data);
    }
   
    /**
     *
     *
     * @return void
     */
    public function getSuperviseeWorkspace(Request $request, $regno)
    {
        $user = $request->user();

        if( !preg_match('/[uU]\d{2}[a-zA-Z]{2}[123]{1}\d{3}$/', $regno)) {
            return redirect()->back()->with('error', 'Invalid registration number!');
        }

        dd($request->all());

        $supervisory_group = SupervisoryGroup::where([
            ['supervisor_id', $user->id],
            ['supervision_type', 'project'],
            ['session', config('global.session')],
        ])->first();

        // supervisess
        $sg_supervisees = ($supervisory_group)?$supervisory_group->supervisee:[];
        // $sg_supervisees = Supervisee::where('supervisory_group_id', $sgid)->get()->all();
        $supervisees = [];
         foreach($sg_supervisees as $sg_supervisee){
            $id = $sg_supervisee->id;
            $user_id = $sg_supervisee->student_id;
            $name = $sg_supervisee->getFullName();
            $regno = $sg_supervisee->getCapRegno();
            $supervisees[] = [
                'id' => $id,
                'name' => $name,
                'regno' => $regno,
                'isActive' => false,
            ];
        }

        $data = [
            'page_name' => 'project',
            'supervisees' => $supervisees,
        ];

        return view('lecturer.project_supervision.workspace', compact('data'));
       
    }

    
    /**
     *
     *
     * @return void
     */
    public function uploadReview(Request $request)
    {

        $user = $request->user();

        
        $validatedData = $request->validate([
            'document_id' => 'required|numeric',
            'document' => 'required',
            'chapter_no' => 'sometimes|numeric',
            'comment' => 'sometimes',
        ]);
        
        $document_id = $validatedData['document_id'];
        $document = ProjectDocumentation::where('id', $document_id)->first();
        
        
        $fileName = str_replace('upload', 'review', $document->filename);
        $validatedData['status'] = "none";
        $validatedData['type'] = 'review';
        $validatedData['filename'] = $fileName;
        $validatedData['comment'] = ($validatedData['comment'])?$validatedData['comment']:"No comment...";
        $validatedData['version'] = $document->version;
        $validatedData['supervisee_id'] = $document->supervisee_id;
        $validatedData['chapter_no'] = $document->chapter_no;
        $validatedData['session'] = config('global.session');

        $validatedData['document']->storeAs('public/documentation', $fileName);

        $projectDocumentation = ProjectDocumentation::create($validatedData);

        return redirect()->back()->with('success', 'Document uploaded successfully!');
       
    }
    
    /**
     *
     *
     * @return void
     */
    public function approveChapter(Request $request)
    {

        $user = $request->user();
        

        
        $validatedData = $request->validate([
            'supervisee_id' => 'required|numeric',
            'chapter_no' => 'required|numeric',
        ]);
        
        $supervisee_id = $validatedData['supervisee_id'];
        $chapter_no = $validatedData['chapter_no'];
        
        $document = ProjectDocumentation::where([
            ['supervisee_id', $supervisee_id],
            ['chapter_no', $chapter_no],
            ])->first();

        $document->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Document uploaded successfully!');
       
    }

}
