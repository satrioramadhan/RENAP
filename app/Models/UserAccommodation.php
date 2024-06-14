<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accommodation_id',
        'distance'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Accommodation
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
