<?php

use Faker\Generator as Faker;

$factory->define(App\Timeslot::class, function (Faker $faker) {
    return [
        'teacher_id' => 1,
        'date' => date('Y-m-d', $faker->dateTimeInInterval('now', '+5 days')->format('U')),
        'hour' => $faker->time()
    ];
});
