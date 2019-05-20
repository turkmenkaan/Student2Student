<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(App\User::class, function (Faker $faker) {

    $schools = [
        'Üsküdar Amerikan Lisesi',
        'St. Joseph Lisesi',
        'Robert Koleji',
        'Alman Lisesi',
        'Kadıköy Anadolu Lisesi'
    ];

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'school' => $schools[random_int(0, 4)],
        'class' => random_int(9, 12),
        'cost' => random_int(50, 150),
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.',
        'email_verified_at' => now(),
        'isTeacher' => random_int(0, 1),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
