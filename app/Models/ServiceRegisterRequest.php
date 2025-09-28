<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRegisterRequest extends Model
{
    use HasFactory;

    protected $table = 'service_requests'; // Tablo adı düzeltildi

    protected $fillable = [
        'company_name',
        'service_type',
        'description',
        'address',
        'phone',
        'email',
        'password'
    ];
}
