<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('landing');
})->name('landing');

Route::get('/about', function () {
    return view('about');
})->name('about');

// What is the problem with this route??
//Route::get('/', 'HomeController@showLanding')->name('landing');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile/{id}', 'UserController@show')->name('profile');
    Route::get('/teachers', 'TeacherController@index')->name('teachers');
    Route::get('/lessons', 'CourseController@index')->name('lessons');
    Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('/reserve/{course}/{user}', 'ReservationController@store')->name('reserveCourse');

    Route::get('/timetable', function () {
        return view('timetable');
    });

    /** API ENDPOINTS (might move to api.php later) */
    Route::get('/times/{id}/{date}', 'TimeslotController@index');
    Route::post('/times', 'TimeslotController@store');
    Route::delete('/times', 'TimeslotController@destroy');

    Route::get('/teacher/{id}', 'TeacherController@show');

    Route::get('/courseList', 'CourseController@list');
    Route::post('/reserve', 'ReservationController@store');
    /* END OF API ENDPOINTS */

    Route::group(['middleware' => 'isAdmin'], function () {
        Route::get('/admin', 'AdminController@index')->name('adminPanel');
        Route::get('/admin/{modal}', 'AdminController@getModal')->name('ap_modal');
        Route::get('/admin/settings', 'AdminController@settins')->name('ap_settings');
    });

});

Route::group(['middleware' => 'isTeacher'], function () {
  Route::get('/lessons/create', 'CourseController@create')->name('createLessonForm');
  Route::post('/lessons/store', 'CourseController@store')->name('storeLesson');
});

Route::get('/contact', 'AdminController@viewContact')->name('contact');
Route::post('/contact', 'AdminController@storeContact')->name('sendContact');

Route::get('/rating/{id}', 'UserController@showRating');
Route::post('/rate/', 'UserController@updateRating');

Route::post('/comment/{id}', 'CommentController@store')->name('comment');
Route::post('/registerTeacher', 'TeacherController@store')->name('registerTeacher');
Route::post('/profile/{id}/update', 'UserController@update')->name('updateProfile');
Route::post('/requestCourse', 'CourseController@storeRequest')->name('requestCourse');


