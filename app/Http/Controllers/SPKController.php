<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\UserAccommodation;
use App\Models\Weight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SPKController extends Controller
{
    public function checkSPK()
    {
        $user = Auth::user();
        // Cek apakah ada data final_scores atau saw_preference_values untuk user yang login
        $finalScoresExist = DB::table('final_scores')->where('user_id', $user->id)->exists();
        $sawResultsExist = DB::table('saw_preference_values')->where('user_id', $user->id)->exists();

        if ($finalScoresExist || $sawResultsExist) {
            return redirect()->route('spk.results');
        } else {
            return redirect()->route('spk.index');
        }
    }

    public function showAccommodations()
    {
        $accommodations = Accommodation::all();
        return view('spk.index', compact('accommodations'));
    }

    public function chooseAccommodations(Request $request)
    {
        // Simpan pilihan akomodasi di session
        $request->session()->put('chosen_accommodations', $request->accommodations);
        return redirect()->route('spk.distance');
    }

    public function inputDistance(Request $request)
    {
        $accommodations = Accommodation::whereIn('id', $request->session()->get('chosen_accommodations'))->get();
        return view('spk.distance', compact('accommodations'));
    }

    public function storeDistance(Request $request)
    {
        $user = Auth::user();
        $accommodations = $request->session()->get('chosen_accommodations');

        foreach ($accommodations as $index => $accommodation_id) {
            UserAccommodation::create([
                'user_id' => $user->id,
                'accommodation_id' => $accommodation_id,
                'distance' => $request->distances[$index]
            ]);
        }

        return redirect()->route('spk.weights');
    }

    public function inputWeights()
    {
        return view('spk.weights');
    }

    public function storeWeights(Request $request)
    {
        $user = Auth::user();

        Weight::create([
            'user_id' => $user->id,
            'weight_rating' => $request->weight_rating,
            'weight_price' => $request->weight_price,
            'weight_distance' => $request->weight_distance,
            'weight_public_facilities' => $request->weight_public_facilities,
            'weight_facilities' => $request->weight_facilities,
            'weight_distance_to_city' => $request->weight_distance_to_city
        ]);

        return redirect()->route('spk.results');
    }

    public function showResults()
    {
        $user = Auth::user();
        $finalScores = DB::table('final_scores')
            ->where('user_id', $user->id)
            ->join('accommodations', 'final_scores.accommodation_id', '=', 'accommodations.id')
            ->select('accommodations.name', 'final_scores.final_score')
            ->get();

        $sawResults = DB::table('saw_preference_values')
            ->where('user_id', $user->id)
            ->join('accommodations', 'saw_preference_values.accommodation_id', '=', 'accommodations.id')
            ->select('accommodations.name', 'saw_preference_values.preference_value')
            ->get();

        return view('spk.results', compact('finalScores', 'sawResults'));
    }

    public function resetSPK()
    {
        $user = Auth::user();
        UserAccommodation::where('user_id', $user->id)->delete();
        Weight::where('user_id', $user->id)->delete();

        return redirect()->route('spk.index');
    }


}
