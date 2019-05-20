<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_id',
        'timeslot_id',
        'course_id',
        'isDone',
        'isCancelled'
    ];

    public function student() {
        return $this->belongsTo('App\User');
    }

    public function teacher() {
        return $this->belongsTo('App\User');
    }

    public function timeslot() {
        return $this->belongsTo('App\Timeslot');
    }

    public function course() {
        return $this->belongsTo('App\Course');
    }
}
