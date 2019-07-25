<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularCourses = Course::orderBy('amount_taken', 'desc')->take(5)->get();
        $popularTeachers = User::where('isTeacher', 1)->orderBy('rating', 'desc')->take(5)->get();
        return view('home', compact('popularCourses', 'popularTeachers'));
    }

    /**
     * Show the landing page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLanding() {
        return view('landing');
    }
}
