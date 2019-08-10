<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('school');
            $table->integer('class')->nullable();
            $table->integer('cost')->default(100);
            $table->text('description');
            $table->float('rating')->default(0);
            $table->integer('ratersNumber')->default(0);
            $table->boolean('isTeacher')->default(0);
            $table->boolean('isAdmin')->default(0);
            $table->string('photoUrl')->default('storage/images/default.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_requests');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('users');
    }
}
