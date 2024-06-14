<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight_rating',
        'weight_price',
        'weight_distance',
        'weight_public_facilities',
        'weight_facilities',
        'weight_distance_to_city'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
