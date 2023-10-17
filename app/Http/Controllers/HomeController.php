<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

       /**
     * .
     *
     * @return void
     */
    public function lecturers(Request $request)
    {
        $user = $request->user();
        
        $lecturers = User::where('usertype', 'lecturer')->get();

        $data = [
            'page_name' => 'project',
            'lecturers' => $lecturers,
        ];

        return view('lecturers', compact('data'));
    }
 
    /**
     * .
     *
     * @return void
     */
    public function students(Request $request)
    {
        $user = $request->user();
        
        $students = User::where('usertype', 'student')->get();

        $data = [
            'page_name' => 'project',
            'students' => $students,
        ];

        return view('students', compact('data'));
    }

    /**
     * .
     *
     * @return void
     */
    public function getProfile( Request $request )
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
        ]);
        
        $user_id = $validatedData['user_id'];
        
        $redirect = "/profile/$user_id";

        return redirect( $redirect );
    }
    
    /**
     * .
     *
     * @return void
     */
    public function profile(Request $request, $id)
    {
        $did = decode($id);

        $profile = User::find($did);

        $data = [
            'page_name' => 'schedule',
            'profile' => $profile,
            'isProfileOwner' => ($profile->id == $request->user()->id),
        ];
        
        return view('profile', compact('data'));
    }
    
    /**
     * .
     *
     * @return void
     */
    public function getEditProfile( Request $request )
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
        ]);
        
        $user_id = $validatedData['user_id'];

        $redirect = route('get.edit.profile') . "/$user_id";

        return redirect( $redirect );
    }
    
    /**
     * .
     *
     * @return void
     */
    public function editProfile( $id )
    {
        $user_id = decode($id);
        
        $profile = User::find($user_id);

        $data = [
            'page_name' => 'schedule',
            'profile' => $profile,
        ];

        return view('profile_edit', compact('data'));
    }

    /**
     * .
     *
     * @return void
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        
        $profile = User::find($user->id);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

}
