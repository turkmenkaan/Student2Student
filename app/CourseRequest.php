<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseRequest extends Model
{
    protected $table = 'course_requests';
    protected $fillable = [
        'name', 'description', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
