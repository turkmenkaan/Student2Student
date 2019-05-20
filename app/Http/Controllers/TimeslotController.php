<?php

namespace App\Http\Controllers;

use App\Timeslot;
use Illuminate\Http\Request;

class TimeslotController extends Controller
{
    public function index ($id, $date)
    {
        $times = Timeslot::whereDate('date', $date)
            ->where('isAvailable', 1)
            ->where('teacher_id', $id)->get();
        return $times;
    }

    public function store (Request $request)
    {
        $ifExists = Timeslot::where('teacher_id', $request->teacher_id)
            ->where('hour', $request->hour)
            ->where('date', $request->date)->exists();

        if (!$ifExists) {
            $timeslot = new Timeslot;
            $timeslot->teacher_id = $request->teacher_id;
            $timeslot->hour = $request->hour;
            $timeslot->date = $request->date;
            $timeslot->save();
        }

        return "Timeslot Successfully Created!";
    }

    public function destroy (Request $request)
    {
        $timeslot = Timeslot::where('hour', $request->hour)
            ->where('date', $request->date)
            ->where('teacher_id', $request->teacher_id)
            ->delete();

        return "Timeslot Successfully Deleted!";
    }
}
