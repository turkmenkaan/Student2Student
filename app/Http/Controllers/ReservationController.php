<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Reservation;
use App\Timeslot;
use App\Mail\ConfirmReservation;
use App\Mail\ReservationDenied;
use App\Mail\ReservationConfirmed;
use App\Mail\ReservationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public $studentEmail;
    public $teacherEmail;

    public function store (Request $request)
    {
        $timeslot = Timeslot::where('date', $request->date)
            ->where('hour', $request->hour)->firstOrFail();
        $timeslot->isAvailable = 0;
        $timeslot->save();

        $course = Course::where('name', $request->course)->first();

        $reservation = new Reservation;
        $reservation->student_id = $request->student;
        $reservation->teacher_id = $request->teacher;
        $reservation->timeslot_id = $timeslot->id;
        $reservation->course_id = $course->id;
        $reservation->save();

        $studentEmail = User::where('id', $request->student)->first()->email;
        $teacherEmail = User::where('id', $request->teacher)->first()->email;

        Mail::to($teacherEmail)->send(new ConfirmReservation($reservation));
        Mail::to($studentEmail)->send(new ReservationNotification($reservation));
    }

    public function update (Request $request)
    {
        $timeslot = Timeslot::where('teacher_id', $request->teacher_id)
            ->where('date', $request->date)
            ->where('hour', $request->hour)->first();

        $course = Course::where('name', $request->course)->first()->id;

        $reservation = Reservation::where('timeslot_id', $timeslot->id)
            ->where('student_id', $request->studentId)
            ->where('course_id', $course)->first();

        $reservation->isApproved = 1;
        $reservation->save();

        $studentEmail = User::where('id', $request->studentId)->first()->email;
        $teacherEmail = User::where('id', $request->teacher_id)->first()->email;

        Mail::to($studentEmail)->send(new ReservationConfirmed($reservation));
    }

    public function deny (Request $request)
    {
        $studentEmail = User::where('id', $request->studentId)->first()->email;

        $timeslot = Timeslot::where('teacher_id', $request->teacher_id)
            ->where('date', $request->date)
            ->where('hour', $request->hour)->first();
        $timeslot->isAvailable = 1;
        $timeslot->save();

        $reservation = Reservation::where('timeslot_id', $timeslot->id)
            ->where('student_id', $request->studentId)->first();

        Mail::to($studentEmail)->send(new ReservationDenied($reservation));

        $reservation->delete();
    }
}
