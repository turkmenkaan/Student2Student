<?php

namespace App\Http\Controllers;

use App\Course;
use App\Jobs\SendReservationStatusMail;
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

        /*
         * POSSIBLE CONFUSION ALERT:
         * ConfirmReservation is the name of the email sent when a student requests
         * a lesson, not the one sent when a lesson is confirmed by the teacher.
         * The email sent when a lesson is actually confirmed is ReservationConfirmed.
         */
        Mail::to($teacherEmail)->send(new ConfirmReservation($reservation));
        Mail::to($studentEmail)->send(new ReservationNotification($reservation));
    }

    public function update (Request $request)
    {
        $timeslot = Timeslot::where('teacher_id', $request->teacher_id)
            ->where('date', $request->date)
            ->where('hour', $request->hour)->first();

        $course = Course::where('name', $request->course)->first();

        $reservation = Reservation::where('timeslot_id', $timeslot->id)
            ->where('student_id', $request->studentId)
            ->where('course_id', $course->id)->first();

        $course->amount_taken += 1;
        $course->save();

        $reservation->isApproved = 1;
        $reservation->save();

        $studentEmail = User::where('id', $request->studentId)->first()->email;
        $teacherEmail = User::where('id', $request->teacher_id)->first()->email;

        SendReservationStatusMail::dispatch($studentEmail, 'confirmed', $reservation)->delay(now()->addSeconds(5));
    }

    /**
     * @param Request $request
     */
    public function deny (Request $request)
    {
        $studentEmail = User::where('id', $request->student_id)->first()->email;

        $timeslot = Timeslot::where('teacher_id', $request->teacher_id)
            ->where('date', $request->date)
            ->where('hour', $request->hour)->first();
        $timeslot->isAvailable = 1;
        $timeslot->save();

        $reservation = Reservation::where('timeslot_id', $timeslot->id)
            ->where('student_id', $request->student_id)->first();

        SendReservationStatusMail::dispatch($studentEmail, 'denied', $reservation)->delay(now()->addSeconds(5));

        $reservation->delete();
    }
}
