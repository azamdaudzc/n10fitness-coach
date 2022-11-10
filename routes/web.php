<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\N10Controllers\WarmupBuilderController;
use App\Http\Controllers\UserControllers\UserCoachController;
use App\Http\Controllers\N10Controllers\ExerciseLibraryController;
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


Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/migratedatabase', function () {
    Artisan::call('migrate:fresh --seed');
});

Route::middleware(['auth','check_user_type','verified'])->group(function () {

    Route::get('/', function () {
        $data['page_heading']="Dashboard";
        $data['sub_page_heading']="main dashboard";
        return view('dashboard')->with($data);
    });
    Route::get('/dashboard', function () {
        $data['page_heading']="Dashboard";
        $data['sub_page_heading']="main dashboard";
        return view('dashboard')->with($data);
    })->name('dashboard');

    Route::controller(WarmupBuilderController::class)->group(function(){
        Route::get('warmup/builder/lists', 'list')->name('warmup.builder.list');
        Route::get('warmup/builder/create-edit{id?}', 'create_edit')->name('warmup.builder.create-edit');
        Route::get('warmup/builder/index','index')->name('warmup.builder.index');
        Route::post('warmup/builder/details', 'details')->name('warmup.builder.details');
        Route::post('warmup/builder/store','store')->name('warmup.builder.store');
        Route::get('warmup/builder/view/{id?}', 'view')->name('warmup.builder.view');
        Route::post('warmup/builder/delete', 'delete')->name('warmup.builder.delete');

    });

    Route::controller(ExerciseLibraryController::class)->group(function(){
        Route::get('exerciselibrary', 'index')->name('exerciselibrary.index');
        Route::get('exerciselibrary/lists', 'list')->name('exerciselibrary.list');
        Route::get('exerciselibrary/create-edit/{id?}', 'create_edit')->name('exerciselibrary.create-edit');
        Route::post('exerciselibrary/details', 'details')->name('exerciselibrary.details');
        Route::post('exerciselibrary/info', 'info')->name('exerciselibrary.info');
        Route::post('exerciselibrary/store', 'store')->name('exerciselibrary.store');
        Route::post('exerciselibrary/delete', 'delete')->name('exerciselibrary.delete');
        Route::post('exerciselibrary/approve', 'approve')->name('exerciselibrary.approve');
        Route::post('exerciselibrary/reject', 'reject')->name('exerciselibrary.reject');
        Route::get('exerciselibrary/view/{id?}', 'view')->name('exerciselibrary.view');
    });

    Route::controller(UserCoachController::class)->group(function(){
          Route::get('user/coach/profile', 'profile')->name('user.coach.profile');
          Route::post('user/coach/details', 'details')->name('user.coach.details');
          Route::post('user/coach/info', 'info')->name('user.coach.info');
          Route::post('user/coach/store', 'store')->name('user.coach.store');

    });
});


require __DIR__.'/auth.php';
