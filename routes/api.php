<?php

use App\Http\Controllers\NotificationsController;
use Illuminate\Support\Facades\Route;

Route::get('/notifications', [NotificationsController::class, 'getNotification']);
Route::post('/notifications', [NotificationsController::class, 'createNotification']);
