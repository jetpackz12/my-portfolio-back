<?php

namespace App\Http\Controllers;

use App\Models\AboutMeEducational;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AboutMeEducationalController extends Controller
{

    const CACHE_KEY = "AboutMeEducational";
    const CACHE_SECONDS = 60 * 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            return AboutMeEducational::all();
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => "required|unique:about_me_educationals,title",
            'school' => "required",
            'year' => "required",
        ]);

        $data = [];

        $about_me_educational = new AboutMeEducational();
        $about_me_educational->title = $validate['title'];
        $about_me_educational->school = $validate['school'];
        $about_me_educational->year = $validate['year'];
        $about_me_educational->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully add new data!",
            'data' => $about_me_educational
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $about_me_educational = AboutMeEducational::find($id);

        return response()->json($about_me_educational);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => "required|unique:about_me_educationals,title," . $id,
            'school' => "required",
            'year' => "required"
        ]);

        $data = [];

        $about_me_educational = AboutMeEducational::findOrFail($id);
        $about_me_educational->title = $validate['title'];
        $about_me_educational->school = $validate['school'];
        $about_me_educational->year = $validate['year'];
        $about_me_educational->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully update this data!",
            'data' => $about_me_educational
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $about_me_educational = AboutMeEducational::findOrFail($id);
        $about_me_educational->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => "You have successfully delete this data!"]);
    }
}
