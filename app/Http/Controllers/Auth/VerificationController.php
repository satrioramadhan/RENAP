<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request, $id, $hash)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Verifikasi hash
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect('/')->withErrors(['email' => 'Tautan verifikasi tidak valid.']);
        }

        // Cek apakah email sudah diverifikasi
        if ($user->hasVerifiedEmail()) {
            return redirect('/')->with('status', 'Email Anda telah diverifikasi!');
        }

        // Tandai email sebagai diverifikasi
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Login pengguna setelah verifikasi
        Auth::login($user);

        return redirect('/')->with('status', 'Email Anda telah diverifikasi!');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Verifikasi email telah dikirim ulang.');
    }
}
