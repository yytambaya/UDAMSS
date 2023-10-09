<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProjectWorkController;
use App\Http\Controllers\ProjectWorkSupervisionController;
use App\Http\Controllers\ProjectWorkCoordinationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',  function () { redirect( route('general.announcement') ); });

Route::prefix('announcement')->group( function() {

    Route::get('/', function () { redirect( route('general.announcement') ); });
    
    Route::get('/general', [AnnouncementController::class, 'general'])->name('general.announcement');
    Route::post('/general/post', [AnnouncementController::class, 'postAnnouncement'])->name('post.general.announcement');
    Route::post('/general/edit', [AnnouncementController::class, 'editAnnouncement'])->name('edit.general.announcement');
    Route::post('/general/delete', [AnnouncementController::class, 'deleteAnnouncement'])->name('delete.general.announcement');

    Route::get('/staff', [AnnouncementController::class, 'staff'])->name('staff.announcement');
    Route::post('/staff', [AnnouncementController::class, 'postStaff'])->name('post.staff.announcement');

    Route::get('/level4', [AnnouncementController::class, 'level4'])->name('level4.announcement');
    Route::post('/level4', [AnnouncementController::class, 'postLevel4'])->name('post.level4.announcement');
    
    Route::get('/level3', [AnnouncementController::class, 'level3'])->name('level3.announcement');
    Route::post('/level3', [AnnouncementController::class, 'postLevel3'])->name('post.level3.announcement');
    
    Route::get('/level2', [AnnouncementController::class, 'level2'])->name('level2.announcement');
    Route::post('/level2', [AnnouncementController::class, 'postLevel2'])->name('post.level2.announcement');
    
    Route::get('/level1', [AnnouncementController::class, 'level1'])->name('level1.announcement');
    Route::post('/level1', [AnnouncementController::class, 'postLevel1'])->name('post.level1.announcement');
    
});

Route::prefix('student')->group( function() {

    Route::get('/', [ProjectWorkController::class, 'indexs'])->name('dashboard');

    Route::get('/profile', [ProjectWorkController::class, 'profile'])->name('profile');

    Route::get('/project/submission', [ProjectWorkController::class, 'submission'])->name('student.submission.project');
    Route::post('/project/submission/submit', [ProjectWorkController::class, 'submit'])->name('submit.student.submission.project');
    Route::post('/project/submission', [ProjectWorkController::class, 'updateSubmission'])->name('update.student.submission.project');

    Route::get('/project/interaction', [ProjectWorkController::class, 'interaction'])->name('student.interaction.project');
    Route::post('/project/interaction/postmessage', [ProjectWorkController::class, 'postInteractionMessage'])->name('postinteractionmessage.student.interaction.project');
    Route::post('/project/interaction/editmessage', [ProjectWorkController::class, 'editInteractionMessage'])->name('editinteractionmessage.student.interaction.project');
    Route::post('/project/interaction/deletemessage', [ProjectWorkController::class, 'deleteInteractionMessage'])->name('deleteinteractionmessage.student.interaction.project');

    
    Route::get('/project/workspace', [ProjectWorkController::class, 'workspace'])->name('student.workspace.project');
    Route::post('/project/workspace/upload', [ProjectWorkController::class, 'uploadDocument'])->name('upload.student.workspace.project');

    
});

Route::prefix('project')->group( function() {

    Route::get('/', [ProjectWorkSupervisionController::class, 'indexs'])->name('project');


    Route::get('/supervision', [ProjectWorkSupervisionController::class, 'index'])->name('supervision.project');
    
    Route::get('/supervision/students', [ProjectWorkSupervisionController::class, 'students'])->name('students.supervision.project');
    
    Route::get('/supervision/interaction', [ProjectWorkSupervisionController::class, 'interaction'])->name('interaction.supervision.project');
    Route::post('/supervision/interaction/postmessage', [ProjectWorkSupervisionController::class, 'postInteractionMessage'])->name('postinteractionmessage.supervision.project');
    
    Route::get('/supervision/workspace', [ProjectWorkSupervisionController::class, 'workspace'])->name('workspace.supervision.project');
    Route::post('/supervision/workspace', [ProjectWorkSupervisionController::class, 'postWorkspace'])->name('post.workspace.supervision.project');
    Route::post('/supervision/workspace/uploadreview', [ProjectWorkSupervisionController::class, 'uploadReview'])->name('uploadreview.workspace.supervision.project');
    Route::post('/supervision/workspace/approvechapter', [ProjectWorkSupervisionController::class, 'approveChapter'])->name('approvechapter.workspace.supervision.project');
    // Route::get('/supervision/workspace/{regno}', [ProjectWorkSupervisionController::class, 'getSuperviseeWorkspace'])->name('getsuperviseeworkspace.supervision.project');
    
    // coordination 
    Route::get('/coordination', [ProjectWorkCoordinationController::class, 'index'])->name('coordination.project');
    // Route::post('/coordination', [ProjectWorkCoordinationController::class, 'getSuperviseesInfo'])->name('post.coordination.project');
    Route::get('/coordination/supervision', [ProjectWorkCoordinationController::class, 'supervision'])->name('supervision.coordination.project');
    Route::post('/coordination/supervision', [ProjectWorkCoordinationController::class, 'getSupervisoryInfo'])->name('getsupervisoryinfo.coordination.project');
    Route::post('coordination/supervision/supervisees', [ProjectWorkCoordinationController::class, 'getSupervisorSupervisees'])->name('getsupervisorsupervisees.coordination.project'); //AJAX
    
    Route::get('/coordination/submissions', [ProjectWorkCoordinationController::class, 'submissions'])->name('submissions.coordination.project');
    Route::post('/coordination/submission/open', [ProjectWorkCoordinationController::class, 'openSubmission'])->name('opensubmission.coordination.project');
    Route::post('/coordination/submission/close', [ProjectWorkCoordinationController::class, 'closeSubmission'])->name('closesubmission.coordination.project');
    Route::post('/coordination/submission/approve', [ProjectWorkCoordinationController::class, 'approveSubmission'])->name('approvesubmission.coordination.project');
    Route::post('/coordination/submission/approvegroup', [ProjectWorkCoordinationController::class, 'approveGroupSubmissions'])->name('approvegroupsubmissions.coordination.project');
    Route::post('/coordination/submission/approveall', [ProjectWorkCoordinationController::class, 'approveAllSubmissions'])->name('approveallsubmissions.coordination.project');
    
    Route::get('/coordination/setup', [ProjectWorkCoordinationController::class, 'setup'])->name('setup.coordination.project');
    Route::post('coordination/setup/supervisoryGroups/create', [ProjectWorkCoordinationController::class, 'createSupervisoryGroup'])->name('create.supervisory.group');
    Route::post('coordination/setup/supervisee/submit', [ProjectWorkCoordinationController::class, 'submitInformation'])->name('submit.supervisee');
    Route::post('coordination/setup/supervisee/assign', [ProjectWorkCoordinationController::class, 'assignSupervisee'])->name('assign.supervisee');
    Route::post('coordination/setup/supervisee/getreassign', [ProjectWorkCoordinationController::class, 'getReassignSupervisee'])->name('getreassign.supervisee'); //AJAX
    Route::post('coordination/setup/supervisee/reassign', [ProjectWorkCoordinationController::class, 'reassignSupervisee'])->name('reassign.supervisee');

    
});

Auth::routes(['register' => false,]);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');