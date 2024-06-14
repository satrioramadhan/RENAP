<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','image_url', 'url_gmaps', 'address', 'rating', 'price', 'public_facilities',
        'name_facilities_public', 'facilities', 'name_facilities', 'distance_to_city'
    ];

    public function userAccommodations()
    {
        return $this->hasMany(UserAccommodation::class);
    }
}
