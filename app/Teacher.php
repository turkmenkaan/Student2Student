<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function courses() {
        $this->hasMany('App\Course');
    }

    public function reservations() {
        $this->hasMany('App\Reservation');
    }
}
