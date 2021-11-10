<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\EmailController;

use App\Http\Controllers\UserController;
use App\Models\User;

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


Route::get('queue-email', function () {
    $email_list['email'] = 'calvinwongch95@gmail.com';
    // $user = User::whereId(2)->first();
    // $email_list['user'] = $user;

    dispatch(new \App\Jobs\QueueJob($email_list));
    dd('Send Email Successfully');
    // return response()->json($email_list['email']);
});


Route::get('/sendmail', [EmailController::class,'sendEmail']);

Route::resource("user",UserController::class);


//url starts with admin /
Route::prefix('admin')->group(function (){

    //admin controller start
    Route::any('/',[AdminController::class,'index']);

    Route::any('/test',[AdminController::class,'dashboard']);


    Route::any('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');


    Route::any('/usermanagement',[AdminController::class,'usermanagement'])->name('usermanagement');
    Route::get('/delete/{id}',[AdminController::class,'delete']);
    Route::get('/edit/{id}',[AdminController::class,'edit']);
    Route::post('edit',[AdminController::class,'update'])->name('user.edit');
    Route::get('/usermanagement',[AdminController::class,'getUsers']);

    //admin controller end

    //job controller start
    Route::any('/jobmanagement',[JobController::class,'jobmanagement'])->name('jobmanagement');
    Route::get('/jobmanagement',[JobController::class,'getJobs']);
    Route::get('/deletej/{id}',[JobController::class,'delete']);
    Route::get('/editj/{id}',[JobController::class,'edit']);
    Route::post('editj',[JobController::class,'update'])->name('job.edit');

    //job controller end

    //department controller start
    Route::any('/deptmanagement',[DeptController::class,'deptmanagement'])->name('deptmanagement');
    Route::get('/deptmanagement',[DeptController::class,'getDept']);
    Route::get('/deleted/{id}',[DeptController::class,'delete']);
    Route::get('/editd/{id}',[DeptController::class,'edit']);
    Route::post('editd',[DeptController::class,'update'])->name('dept.edit');



    //department controller end


});





