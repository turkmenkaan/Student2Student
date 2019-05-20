<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $fillable = [
      'teacher_id',
      'available_slot'
    ];

    public function teacher() {
        $this->belongsTo('App\User');
    }

    public function reservation() {
        $this->hasOne('App\Reservation');
    }
}
