<?php

namespace App\Http\Controllers;

use App\Course;
use App\Mail\ReservationNotification;
use App\User;
use App\Reservation;
use App\Timeslot;
use App\Mail\ConfirmReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
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

    }
}
