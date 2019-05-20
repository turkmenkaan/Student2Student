<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Reservation;
use App\Timeslot;

class ReservationController extends Controller
{
    public function store (Request $request) {
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
    }
}
