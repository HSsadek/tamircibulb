<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceRegisterRequestController;

Route::post('/service-requests', [ServiceRegisterRequestController::class, 'store']);
