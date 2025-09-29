<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'user_id',
        'company_name',
        'description',
        'working_hours',
        'rating',
        'verified',
    ];
}
