<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string', // düzeltildi
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'message' => 'Email veya şifre hatalı'
            ], 401); // Unauthorized
        }

        // 3. Giriş başarılı, token oluştur
        $token = bin2hex(random_bytes(30)); // Örnek token
        $admin->remember_token = $token;
        $admin->save();

        return response()->json([
            'message' => 'Giriş başarılı',
            'token' => $token,
            'admin' => [
                'id' => $admin->id,
                'email' => $admin->email,
                'name' => $admin->name,
            ]
        ]);
    }
}
