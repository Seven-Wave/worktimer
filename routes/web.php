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
    return redirect('/timer');

});


Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login_process', [App\Http\Controllers\AuthController::class, 'login'])->name('login_process');


Route::middleware("auth")->group(function () {

    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::name('timer.')->prefix('timer')->group(function() {
        Route::get('/', function () {
            return view('timer');
        });

        Route::post('/get_status', [App\Http\Controllers\TimeController::class, 'get_status']);

        Route::name('pause.')->prefix('pause')->group(function () {
            Route::post('/create', [App\Http\Controllers\PauseController::class, 'create']);
        });

        Route::name('worktime.')->prefix('worktime')->group(function () {
            Route::post('/create', [App\Http\Controllers\WorktimeController::class, 'create']);
        });
    });
});





