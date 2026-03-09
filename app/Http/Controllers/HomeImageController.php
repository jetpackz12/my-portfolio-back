<?php

namespace App\Http\Controllers;

use App\Models\HomeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class HomeImageController extends Controller
{
    const CACHE_KEY = "homeImage";
    const CACHE_SECONDS = 60 * 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            return HomeImage::all();
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'name' => 'required|string|max:255|unique:home_images,name'
        ]);

        $data = [];

        $path = $request->file('image')->store('images', 'public');

        $home_image = new HomeImage();
        $home_image->name = $validate['name'];
        $home_image->image_path = $path;
        $home_image->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully add new data!",
            'data' => $home_image
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = HomeImage::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'name' => 'required|string|max:255|unique:home_images,name,' . $id,
        ]);

        $data = [];

        $home_image =  HomeImage::findOrFail($id);

        if ($request->hasFile('image')) {

            Storage::disk('public')->delete($home_image->image_path);

            $path = $request->file('image')->store('images', 'public');

            $home_image->image_path = $path;
        }

        $home_image->name = $validate['name'];
        $home_image->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully update this data!",
            'data' => $home_image
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $home_image = HomeImage::findOrFail($id);

        Storage::disk('public')->delete($home_image->image_path);

        $home_image->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => "You have successfully delete this data!"]);
    }
}
