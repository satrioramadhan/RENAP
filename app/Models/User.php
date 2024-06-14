<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;


class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function retrieveByToken($identifier, $token)
    {
        $user = static::where('email', $identifier)->first();

        if ($user && $user->exists()) {
            $passwordReset = DB::table('password_resets')
                ->where('email', $user->email)
                ->where('token', $token)
                ->first();

            if ($passwordReset && $passwordReset->token === $token) {
                return $user;
            }
        }

        return null;
    }

    public function userAccommodations()
    {
        return $this->hasMany(UserAccommodation::class);
    }

    // Relasi dengan Weight
    public function weights()
    {
        return $this->hasOne(Weight::class);
    }
}
