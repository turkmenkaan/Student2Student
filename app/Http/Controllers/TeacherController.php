<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Timeslot;
use App\Reservation;
use App\Mail\AccountCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = DB::table('users')->where('isTeacher', 1)->get();
        $teachersArray = [];
        foreach ($teachers as $teacher) { array_push($teachersArray, $teacher); };
        $teachersArray = array_chunk($teachersArray, 4);
        return view('teachers', compact('teachersArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * A function just to avoid deleting a big deal of code.
     * I admit, it is not the best practice.
     */
    public function redactad()
    {
        // Create new error messages in Turkish
        $messages = [
            'required' => ':attribute alanını doldurmak zorundasınız!',
            'string' => ':attribute alanına metin girmek zorundasınız!',
            'max' => ':attribute alanı :max karakterden uzun olamaz!',
            'min' => ':attribute alanı :min karakterden kısa olamaz',
            'unique' => 'Bu email sistemimizde kayıtlı!'
        ];

        // Validate every field using a manual Validator
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'school' => 'required',
            'class' => 'required',
            'cost' => 'required|min:50'
        ], $messages);

        // If validator fails, redirect to register view and show errors
        if ($validator->fails()) {
            return redirect('registerTeacher')->withErrors($validator)->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'school' => 'required',
            'class' => 'required',
            'cost' => 'required|numeric|min:50'
        ]);

        $teacher = new User;
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->password = bcrypt($request->input('password'));
        $teacher->school = $request->input('school');
        $teacher->class = $request->input('class');
        $teacher->cost = $request->input('cost');
        $teacher->isTeacher = 1;

        // DON'T FORGET TO ADD A DESC FIELD IN THE REGISTRATION FORM
        $teacher->description = 'Gotta change this desc...';

        $teacher->save();
        Mail::to($teacher->email)->send(new AccountCreated($teacher));
        return redirect('home');
    }

    /**
     * Helper method for store function.
     * Creates custom error messages.
     */
    public function messages()
    {
        return [
            'required' => ':attribute alanını doldurmak zorundasınız!',
            'string' => ':attribute alanına metin girmek zorundasınız!',
            'max' => ':attribute alanı :max karakterden uzun olamaz!',
            'min' => ':attribute alanı :min karakterden kısa olamaz',
            'unique' => 'Bu email sistemimizde kayıtlı!'
        ];
    }

    /**
     * Another helper method for the store function
     * Creates custom attribute names
     */
    public function attributes()
    {
        return [
            'name' => 'isim',
            'password' => 'parola',
            'school' => 'okul',
            'class' => 'sınıf',
            'cost' => 'ücret'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function times ($id, $date)
    {
        $times = Timeslot::whereDate('date', $date)->where('isAvailable', 1)->get();
        return $times;
    }


}

