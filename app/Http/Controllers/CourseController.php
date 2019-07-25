<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseRequest;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $lessons = Course::with('teacher')->get();

        $currentDate = Carbon::now();
        $period = CarbonPeriod::create($currentDate, 7);
        $dates = $period->toArray();

        return view('courses', compact('lessons', 'dates'));
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

    public function search (Request $request)
    {
        $query = $request->input('search');
        $isFound = Course::where('name', 'LIKE', '%' . $query . '%')->exists();
        $lessons = Course::where('name', 'LIKE', '%' . $query . '%')->get();

        $currentDate = Carbon::now();
        $period = CarbonPeriod::create($currentDate, 7);
        $dates = $period->toArray();

        if ($isFound) {
            return view('courses', compact('lessons', 'dates'));
        } else {
            return redirect()->route('home')->with('status', 'Aradığınız ders bulunamadı!');
        }
    }
}
