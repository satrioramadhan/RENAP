<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                Auth::login($user);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make($this->generateRandomPassword()),
                    'email_verified_at'=> now()
                ]);

                $newUser->sendEmailVerificationNotification();

                Auth::login($newUser);
            }

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong or you have rejected the app!');
        }
    }

    public function generateRandomPassword()
     {
         $randomPassword = \Str::random(10) . mt_rand(100, 999) . \Str::random(3) . mt_rand(100, 999);
         return $randomPassword;
    }
}
