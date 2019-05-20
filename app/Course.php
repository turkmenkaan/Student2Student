<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    protected $fillable = [
        'name', 'description', 'cost',
    ];

    public function teacher() {
        return $this->belongsTo('App\User');
    }

    public function reservations() {
        return $this->hasMany('App\Reservation');
    }
}
