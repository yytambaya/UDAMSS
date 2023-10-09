<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;


class AnnouncementController extends Controller
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
     * Redirect to general announcement.
     *
     * @return void
     */
    public function index()
    {
        return redirect( route('general.announcement') );
    }

    /**
     * Show the general announcement.
     *
     * @return void
     */
    public function general()
    {
        
        $data = [
            'page_name' => 'announcements',
            'publicity' => 'general',
            'announcements' => Announcement::where([
                ['publicity','general'],
                ['status','active'],
                ])
                ->orderBy('created_at', 'desc')
                ->get(),
        ];

        return view('announcements', compact('data'));
       
    }

    /**
     * Show the staff announcement.
     *
     * @return void
     */
    public function staff()
    {
        $data = [
            'page_name' => 'announcements',
            'publicity' => 'staff',
            'announcements' => Announcement::where([
                ['publicity','staff'],
                ['status','active'],
                ])
                ->orderBy('created_at', 'desc')
                ->get(),
        ];

        return view('lecturer.announcement', compact('data'));
       
    }

    /**
     * Show the level4 announcement.
     *
     * @return void
     */
    public function level4()
    {
        $data = [
            'page_name' => 'announcements',
            'publicity' => '4',
            'announcements' => Announcement::where([
                ['publicity','level4'],
                ['status','active'],
                ])
                ->orderBy('created_at', 'desc')
                ->get(),
        ];

        return view('student.announcement', compact('data'));
       
    }

    /**
     * Show the level3 announcement.
     *
     * @return void
     */
    public function level3()
    {
        $data = [
            'page_name' => 'announcements',
            'publicity' => '3',
            'announcements' => Announcement::where([
                ['publicity','level3'],
                ['status','active'],
                ])
                ->orderBy('created_at', 'desc')
                ->get(),
        ];

        return view('student.announcement', compact('data'));
       
    }
    /**
     * Show the level2 announcement.
     *
     * @return void
     */
    public function level2()
    {
        $data = [
            'page_name' => 'announcements',
            'publicity' => '2',
            'announcements' => Announcement::where([
                ['publicity','level2'],
                ['status','active'],
                ])
                ->orderBy('created_at', 'desc')
                ->get(),
        ];

        return view('student.announcement', compact('data'));
       
    }

    /**
     * Show the level1 announcement.
     *
     * @return void
     */
    public function level1()
    {
        $data = [
            'page_name' => 'announcements',
            'publicity' => '1',
            'announcements' => Announcement::where([
                ['publicity','level1'],
                ['status','active'],
                ])
                ->orderBy('created_at', 'desc')
                ->get(),
        ];

        return view('student.announcement', compact('data'));
       
    }

    /* *********************************************************
                            POST REQUESTS
    *  *********************************************************
    */

    /**
     * Post a general announcement.
     *
     * @return void
     */
    public function postAnnouncement(Request $request)
    {
        
        $validatedData = $request->validate([
            'publicity' => 'required',
            'content' => 'required',
        ]);

        $validatedData['user_id'] = $request->user()->id;
        $validatedData['publicity'] = (is_numeric($validatedData['publicity']))?
            "level".$validatedData['publicity']:$validatedData['publicity'];
        
        $announcement = Announcement::create($validatedData);

        return back()->with('success', 'Announcement Posted Successfully!');
       
    }
    
    /**
     *
     *
     * @return void
     */
    public function editAnnouncement(Request $request)
    {

        $user = $request->user();

        $validatedData = $request->validate([
            'announcement_id' => 'required|numeric',
            'content' => 'required',
        ]);

        $announcement_id = $validatedData['announcement_id'];
        $announcement = Announcement::where('id', $announcement_id)->first();
        $affected_rows = $announcement->update($validatedData);

        if ( $affected_rows )
            return redirect()->back()->with('success', 'Message updated successfully!');

        return redirect()->back()->with('warning', 'Failed to update message!');       
    }

    /**
     *
     *
     * @return void
     */
    public function deleteAnnouncement(Request $request)
    {

        $user = $request->user();

        $validatedData = $request->validate([
            'announcement_id' => 'required|numeric',
        ]);

        $announcement_id = $validatedData['announcement_id'];
        $announcement = Announcement::where('id', $announcement_id)->first();
        $affected_rows = $announcement->update(['status' => 'hidden']);

        if ( $affected_rows )
            return redirect()->back()->with('success', 'Message updated successfully!');

        return redirect()->back()->with('warning', 'Failed to update message!'); 
       
    }
    

}
