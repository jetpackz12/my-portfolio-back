<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OfferController extends Controller
{

    const CACHE_KEY = "Offer";
    const CACHE_SECONDS = 60 * 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            return Offer::all();
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => "required|unique:offers,title",
            'description' => "required",
            'icon' => "required"
        ]);

        $data = [];

        $offer = new Offer();
        $offer->title = $validate['title'];
        $offer->description = $validate['description'];
        $offer->icon = $validate['icon'];
        $offer->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully add new data!",
            'data' => $offer
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Offer::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => "required|unique:offers,title," . $id,
            'description' => "required",
            'icon' => "required"
        ]);

        $data = [];

        $offer = Offer::findOrFail($id);
        $offer->title = $validate['title'];
        $offer->description = $validate['description'];
        $offer->icon = $validate['icon'];
        $offer->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully update this data",
            'data' => $offer
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => "You have successfully delete this data!"]);
    }
}
