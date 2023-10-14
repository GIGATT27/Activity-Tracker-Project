<?php

use App\Models\Activity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityUpdateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/Home', function () {
    $activities = Activity::all();
    $activities->each(function ($activity) {
        $activity->formatted_date_created = $activity->created_at->format('Y-m-d');
    });

    return view('home',['activities' => $activities]);
});

Route::group([], function() {

    Route::get('/create-activity', function () {
        return view('create');
    });
    
    Route::get('/register', function () {
        return view('registration');
    });
    
    Route::get('/', function () {
        return view('login');
    });

});




Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::get('/logout',[UserController::class,'logout']);


Route::post('/create-activity',[ActivityController::class,'create']);

Route::put('/update-activity/{activity}',[ActivityUpdateController::class,'update']);
Route::get('/daily-activity-updates',[ActivityController::class,'daily_updates']);
Route::get('/get-updated-activities', [ActivityController::class, 'getUpdatedActivities']);

Route::get('/activity/{id}/updates', [ActivityController::class,'getActivityUpdates']);

Route::get('/activity-updates/{activityId}', 'ActivityController@showActivityUpdates')->name('activity.updates');




