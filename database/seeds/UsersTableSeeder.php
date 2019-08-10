<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Kaan Turkmen',
            'email' => 'kaanturkmen2000@gmail.com',
            'class' => 12,
            'gradYear' => 2023,
            'cost' => 150,
            'description' => 'Co-Founder of Student2Student',
            'school' => 'Uskudar Amerikan Lisesi',
            'photoUrl' => 'storage/images/WzeLEIrJAAw5yiNk4AKSITBeHp6X6MTP7btG2tKs.png',
            'rating' => 5.0,
            'ratersNumber' => 21,
            'isTeacher' => 1,
            'isAdmin' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('Kamelya5')
        ]);
        factory(App\User::class, 15)->create();
    }
}
