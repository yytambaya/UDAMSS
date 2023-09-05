<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnoucementController extends Controller
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
     * Redirect to general annoucement.
     *
     * @return void
     */
    public function index()
    {
        return redirect( route('annoucement') );
    }

    /**
     * Show the general annoucement.
     *
     * @return void
     */
    public function general()
    {
        $page_name = 'annoucements';
        return view('annoucements', compact('page_name'));
       
    }

    /**
     * Post an annoucement.
     *
     * @return void
     */
    public function postAnnoucement()
    {
        $page_name = 'annoucements';
        return view('annoucements', compact('page_name'));
       
    }

}
