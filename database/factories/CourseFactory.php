<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'teacher_id' => 1,
        'name' => $faker->name,
        'description' => $faker->text(200),
        'cost' => random_int(50, 150),
    ];
});
