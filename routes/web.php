<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\N10Controllers\WarmupBuilderController;
use App\Http\Controllers\N10Controllers\CoachClientController;
use App\Http\Controllers\N10Controllers\ProgramBuilderController;
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

Route::middleware(['auth', 'check_user_type', 'verified'])->group(function () {

    Route::get('/', function () {
        $data['page_heading'] = "Dashboard";
        $data['sub_page_heading'] = "main dashboard";
        return view('dashboard')->with($data);
    });
    Route::get('/dashboard', function () {
        $data['page_heading'] = "Dashboard";
        $data['sub_page_heading'] = "main dashboard";
        return view('dashboard')->with($data);
    })->name('dashboard');

    Route::controller(WarmupBuilderController::class)->group(function () {
        Route::get('warmup/builder/lists', 'list')->name('warmup.builder.list');
        Route::get('warmup/builder/create-edit{id?}', 'create_edit')->name('warmup.builder.create-edit');
        Route::get('warmup/builder/index', 'index')->name('warmup.builder.index');
        Route::post('warmup/builder/details', 'details')->name('warmup.builder.details');
        Route::post('warmup/builder/store', 'store')->name('warmup.builder.store');
        Route::get('warmup/builder/view/{id?}', 'view')->name('warmup.builder.view');
        Route::post('warmup/builder/delete', 'delete')->name('warmup.builder.delete');
    });

    Route::controller(CoachClientController::class)->group(function () {
        Route::get('coach/client/lists', 'list')->name('coach.client.list');
        Route::get('coach/client/index', 'index')->name('coach.client.index');
    });


    Route::controller(ProgramBuilderController::class)->group(function () {
        Route::get('program/builder/lists', 'list')->name('program.builder.list');
        Route::get('program/builder/create-edit{id?}', 'create_edit')->name('program.builder.create-edit');
        Route::get('program/builder/assign-clients{id?}', 'assign_clients')->name('program.builder.assign-clients');
        Route::post('program/builder/attach-client', 'attach_client')->name('program.builder.attach-client');
        Route::get('program/builder/assigedclients{id?}', 'assigedclients')->name('program.builder.assigedclients');
        Route::post('program/builder/deleteclient', 'deleteclient')->name('program.builder.deleteclient');
        Route::get('program/builder/index', 'index')->name('program.builder.index');
        Route::post('program/builder/details', 'details')->name('program.builder.details');
        Route::post('program/builder/store', 'store')->name('program.builder.store');
        Route::get('program/builder/view/{id?}', 'view')->name('program.builder.view');
        Route::post('program/builder/delete', 'delete')->name('program.builder.delete');
        Route::post('program/builder/details', 'details')->name('program.builder.details');
        Route::post('program/builder/share-program', 'shareProgram')->name('program.builder.share.program');
    });

    Route::controller(ExerciseLibraryController::class)->group(function () {
        Route::get('exercise/library', 'index')->name('exercise.library.index');
        Route::get('exercise/library/lists', 'list')->name('exercise.library.list');
        Route::get('exercise/library/create-edit/{id?}', 'create_edit')->name('exercise.library.create-edit');
        Route::post('exercise/library/details', 'details')->name('exercise.library.details');
        Route::post('exercise/library/info', 'info')->name('exercise.library.info');
        Route::post('exercise/library/store', 'store')->name('exercise.library.store');
        Route::post('exercise/library/delete', 'delete')->name('exercise.library.delete');
        Route::post('exercise/library/approve', 'approve')->name('exercise.library.approve');
        Route::post('exercise/library/reject', 'reject')->name('exercise.library.reject');
        Route::get('exercise/library/view/{id?}', 'view')->name('exercise.library.view');
    });

    Route::controller(UserCoachController::class)->group(function () {
        Route::get('user/coach/profile', 'profile')->name('user.coach.profile');
        Route::post('user/coach/details', 'details')->name('user.coach.details');
        Route::post('user/coach/info', 'info')->name('user.coach.info');
        Route::post('user/coach/store', 'store')->name('user.coach.store');
    });
});


require __DIR__ . '/auth.php';
