<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(TimeslotTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
    }
}
