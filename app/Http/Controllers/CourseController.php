<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $lessons = Course::with('teacher')->get();
        return view('courses', compact('lessons'));
    }

    public function create()
    {
        return view('create_course');
    }

    public function store(Request $request)
    {
        $course = new Course;
        $course->teacher_id = $request->user()->id;
        $course->name = $request->courseName;
        $course->description = $request->courseDescription;
        $course->cost = $request->cost;
        $course->save();

        return redirect()->route('lessons');
    }

    public function storeRequest(Request $request)
    {
        $req = new CourseRequest;
        $req->user_id = $request->user()->id;
        $req->name = $request->lesson_name;
        $req->description = $request->description;
        $req->save();
        return redirect()->back()->with('success','Ders Talebiniz Gönderildi!');
    }

    public function list ()
    {
        return Course::all();
    }
}
