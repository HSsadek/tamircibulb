<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRegisterRequest;

class ServiceRegisterRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'service_type' => 'required|string|in:authorized,private,independent',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',             // en az 8 karakter
            ],
        ]);

        $serviceRequest = ServiceRegisterRequest::create($validated);

        return response()->json([
            'success' => true,
            'data' => $serviceRequest
        ], 201);
    }


    public function getServiceRequests()
    {
        // created_at alanına göre her zaman ASC sıralama
        $serviceRequests = ServiceRegisterRequest::orderBy('created_at', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $serviceRequests
        ]);
    }
}
