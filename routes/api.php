<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceRegisterRequestController;
use App\Http\Controllers\AdminAuthController;

Route::post('/service-requests', [ServiceRegisterRequestController::class, 'store']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::post('/service-requests/{id}/approve-and-move', [ServiceRegisterRequestController::class, 'approveAndMove']);
Route::post('/admin/service-requests/{id}/approve', [ServiceRegisterRequestController::class, 'approveAndMove']);

Route::post('/admin/service-requests/{id}/reject', [ServiceRegisterRequestController::class, 'reject']);

Route::get('/get-service-requests', [ServiceRegisterRequestController::class, 'getServiceRequests']);
