<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

//*********************************************************************************************** */


Route::group(['middleware' => 'auth'], function () {
    Route::get('/workouts', 'WorkoutController@index')->name('workout.index');
    Route::get('/workouts/create', 'WorkoutController@create');
    Route::post('/workouts', 'WorkoutController@store');
    Route::get('/workouts/{workout}', 'WorkoutController@show')->name('workout.show');
    Route::patch('/workouts/{workout}', 'WorkoutController@update')->name('workout.update');
    Route::delete('/workouts/{workout}', 'WorkoutController@destroy')->name('workout.destroy');

    Route::post('/workouts/{workout}/days', 'DayController@store');
    Route::patch('/workouts/{workout}/days/{day}', 'DayController@update');
    Route::get('/workouts/{workout}/days/{day}', 'DayController@show');
    Route::delete('/workouts/{workout}/days/{day}', 'DayController@destroy');

    Route::post('/workouts/{workout}/days/{day}/excercises', 'ExcerciseController@store');
    Route::patch('/workouts/{workout}/days/{day}/excercises/{excercise}', 'ExcerciseController@update');
    Route::delete('/workouts/{workout}/days/{day}/excercises/{excercise}', 'ExcerciseController@destroy');


    Route::get('/shared/workouts', 'SharedWorkoutController@index')->name('shared.workout.index');
});

// Route::get('/alpine', function () {
//     return view('alpine');
// });
