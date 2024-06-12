<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class AccommodationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pagesize = $request->input('pagesize', 10);

        if ($search) {

            $accommodations = Accommodation::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%")
                ->orWhere('rating', 'LIKE', "%{$search}%")
                ->paginate($pagesize);
        } else {
            $accommodations = Accommodation::paginate($pagesize);
        }

        return view('view-admin.accommodation.index', compact('accommodations', 'search', 'pagesize'));
    }


    public function create()
    {
        return view('view-admin.accommodation.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'required|string|max:255',
            'url_gmaps' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'price' => 'required|numeric',
            'public_facilities' => 'required|numeric',
            'name_facilities_public' => 'required|string|max:255',
            'facilities' => 'required|numeric',
            'name_facilities' => 'required|string|max:255',
            'distance_to_city' => 'required|numeric',
        ]);

        Accommodation::create($validated);
        return redirect()->route('admin.accommodations.index')->with('success', 'Data tempat inap berhasil ditambah.');
    }

    public function show(Accommodation $accommodation)
    {
        return view('view-admin.accommodation.show', compact('accommodation'));
    }

    public function edit(Accommodation $accommodation)
    {
        return view('view-admin.accommodation.edit', compact('accommodation'));
    }

    public function update(Request $request, Accommodation $accommodation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'required|string|max:255',
            'url_gmaps' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'price' => 'required|numeric',
            'public_facilities' => 'required|numeric',
            'name_facilities_public' => 'required|string|max:255',
            'facilities' => 'required|numeric',
            'name_facilities' => 'required|string|max:255',
            'distance_to_city' => 'required|numeric',
        ]);

        $accommodation->update($validated);
        return redirect()->route('admin.accommodations.index')->with('success', 'Data tempat inap berhasil diupdate.');
    }

    public function destroy(Accommodation $accommodation)
    {

        $accommodation->delete();

        return redirect()->route('admin.accommodations.index');
    }
}
