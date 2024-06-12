<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Accommodation;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalUsers = User::count();
        $totalAccommodations = Accommodation::count();
        $totalAdmins = User::where('is_admin', true)->count();
        $newUsers = User::latest()->take(5)->get();

        return view('view-admin.dashboard', compact('totalUsers', 'totalAccommodations', 'totalAdmins', 'newUsers'));
    }
}


