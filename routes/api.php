<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceRegisterRequestController;
use App\Http\Controllers\AdminAuthController;

Route::post('/service-requests', [ServiceRegisterRequestController::class, 'store']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::get('/get-service-requests', [ServiceRegisterRequestController::class, 'getServiceRequests']);
