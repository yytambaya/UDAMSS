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
            'announcements' => Announcement::where('publicity','general')
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
            'announcements' => Announcement::where('publicity','staff')
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
            'announcements' => Announcement::where('publicity','level4')
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
            'announcements' => Announcement::where('publicity','level3')
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
            'announcements' => Announcement::where('publicity','level2')
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
            'announcements' => Announcement::where('publicity','level1')
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
    public function postGeneral(Request $request)
    {
        
        $validatedData = $request->validate([
            'user_id' => 'sometimes|required',
            'content' => 'required',
        ]);

        $validatedData['user_id'] = $request->user()->id;
        
        // dd($validatedData);
        $announcement = Announcement::create($validatedData);

        return back()->with('success', 'Announcement Posted Successfully!');
       
    }
    
    /**
     * Post a general announcement.
     *
     * @return void
     */
    public function postLevel4(Request $request)
    {
        
        $validatedData = $request->validate([
            'user_id' => 'sometimes|required',
            'content' => 'required',
        ]);

        $validatedData['user_id'] = $request->user()->id;
        $validatedData['publicity'] = 'level4';
        
        $announcement = Announcement::create($validatedData);

        return back()->with('success', 'Announcement Posted Successfully!');
       
    }

}
