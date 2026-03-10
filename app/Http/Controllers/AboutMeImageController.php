<?php

namespace App\Http\Controllers;

use App\Models\AboutMeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AboutMeImageController extends Controller
{

    const CACHE_KEY = "AboutMeImage";
    const CACHE_SECONDS = 60 * 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            return AboutMeImage::all();
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
            'name' => 'required|string|max:255|unique:about_me_images,name'
        ]);

        $data = [];

        $path = $request->file('image')->store('images', 'public');

        $about_me_image = new AboutMeImage();
        $about_me_image->name = $validate['name'];
        $about_me_image->image_path = $path;
        $about_me_image->save();

        $data = [
            'message' => "You have succcesfully add new data!",
            'data' => $about_me_image
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $about_me_image = AboutMeImage::find($id);

        return response()->json($about_me_image);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'name' => 'required|string|max:255|unique:about_me_images,name,' . $id
        ]);

        $data = [];

        $about_me_image = AboutMeImage::findOrFail($id);

        if ($request->hasFile('image')) {

            Storage::disk('public')->delete($about_me_image->image_path);

            $path = $request->file('image')->store('images', 'public');

            $about_me_image->image_path = $path;
        }

        $about_me_image->name = $validate['name'];
        $about_me_image->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully update this data!",
            'data' => $about_me_image
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $about_me_image = AboutMeImage::findOrFail($id);
        $about_me_image->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => "You have successfully delete this data!"]);
    }
}
