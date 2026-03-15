<?php

namespace App\Http\Controllers;

use App\Models\HomeDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeDescriptionController extends Controller
{

    const CACHE_KEY = "HomeDescription";
    const CACHE_SECONDS = 60 * 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            return HomeDescription::all();
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'description' => "required|unique:home_descriptions,description"
        ]);

        $data = [];

        $home_description = new HomeDescription();
        $home_description->description = $validate['description'];
        $home_description->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully add new data!",
            'data' => $home_description
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = HomeDescription::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'description' => "required|unique:home_descriptions,description," . $id
        ]);

        $data = [];

        $home_description = HomeDescription::findOrFail($id);
        $home_description->description = $validate['description'];
        $home_description->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully update this data!",
            'data' => $home_description
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $home_description = HomeDescription::findOrFail($id);
        $home_description->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => "You have successfully delete this data!"]);
    }
}
