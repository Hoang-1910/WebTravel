<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Location;

class HotelController extends Controller
{
    public function index()
    {
        return view('admin.hotel.index', ['hotels' => Hotel::with('location')->get()]);
    }

    public function create()
    {
        return view('admin.hotel.create', ['locations' => Location::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required',
            'rating' => 'required'
        ]);

        Hotel::create($request->all());

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully.');
    }

    public function edit(Hotel $hotel)
    {
        return view('admin.hotel.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required',
            'rating' => 'required'
        ]);

        $hotel->update($request->all());

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel updated successfully');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully');
    }
}
