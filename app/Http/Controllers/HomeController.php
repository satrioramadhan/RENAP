<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;

class HomeController extends Controller
{
    public function index()
    {
        $accommodations = Accommodation::all();
        return view('home', compact('accommodations'));
    }
}

