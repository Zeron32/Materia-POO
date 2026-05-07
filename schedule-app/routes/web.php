<?php

use Illuminate\Support\Facades\Route;

Route::get('/schedules/create', function () {
    return view('schedules.create');
});

use App\Http\Controllers\ScheduleController;
Route::get('/schedules', [ScheduleController::class, 'index']);
Route::post('/schedules', [ScheduleController::class, 'store']);
Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy']);

