<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRegisterRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Http;

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

    public function approveAndMove(Request $request, $id)
    {
        $serviceRequest = ServiceRegisterRequest::findOrFail($id);

        // Adres bilgisini enlem/boylam'a çevir
        $address = $serviceRequest->address;
        $apiKey = 'YOUR_GOOGLE_MAPS_API_KEY'; // Buraya kendi API anahtarınızı girin
        $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
            'address' => $address,
            'key' => $apiKey
        ]);
        $location = null;
        if ($response->ok() && isset($response['results'][0]['geometry']['location'])) {
            $location = $response['results'][0]['geometry']['location'];
        }

        // Yeni servis kaydı oluştur
        $service = Service::create([
            'user_id' => 1, // Gerekirse admin veya başvuran user_id
            'company_name' => $serviceRequest->company_name,
            'description' => $serviceRequest->description,
            'working_hours' => null,
            'rating' => 0,
            'verified' => true,
            // Enlem ve boylamı eklemek için migration'da services tablosuna latitude/longitude ekleyin
            // 'latitude' => $location['lat'] ?? null,
            // 'longitude' => $location['lng'] ?? null,
        ]);

        // Başvuruyu sil
        $serviceRequest->delete();

        return response()->json([
            'success' => true,
            'service' => $service,
            'location' => $location
        ]);
    }

    public function reject(Request $request, $id)
    {
        $serviceRequest = ServiceRegisterRequest::findOrFail($id);
        $serviceRequest->delete();
        return response()->json([
            'success' => true,
            'message' => 'Başvuru reddedildi ve silindi.'
        ]);
    }
}
