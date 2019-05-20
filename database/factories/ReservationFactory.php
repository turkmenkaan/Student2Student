<?php

use Faker\Generator as Faker;

$factory->define(App\Reservation::class, function (Faker $faker) {
    return [
        'student_id' => random_int(1, 15),
        'teacher_id' => 1,
        'timeslot_id' => 1,
        'course_id' => random_int(1, 5),
        'isDone' => random_int(0, 1),
        'isCancelled' => random_int(0, 1),
    ];
});
