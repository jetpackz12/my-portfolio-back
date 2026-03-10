<?php

namespace App\Http\Controllers;

use App\Models\AboutMeWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AboutMeWorkController extends Controller
{

    const CACHE_KEY = "AboutMeWork";
    const CACHE_SECONDS = 60 * 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            return AboutMeWork::all();
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'job' => "required",
            'company' => "required",
            'duration_type' => "required",
            'date_start' => "required",
            'date_end' => "required",
            'description' => "required"
        ]);

        $data = [];

        $about_me_work = new AboutMeWork();
        $about_me_work->job = $validate['job'];
        $about_me_work->company = $validate['company'];
        $about_me_work->duration_type = $validate['duration_type'];
        $about_me_work->date_start = $validate['date_start'];
        $about_me_work->date_end = $validate['date_end'];
        $about_me_work->description = $validate['description'];
        $about_me_work->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully add new data!",
            'data' => $about_me_work
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = AboutMeWork::findOrFail($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'job' => "required",
            'company' => "required",
            'duration_type' => "required",
            'date_start' => "required",
            'date_end' => "required",
            'description' => "required"
        ]);

        $data = [];

        $about_me_work = AboutMeWork::findOrFail($id);
        $about_me_work->job = $validate['job'];
        $about_me_work->company = $validate['company'];
        $about_me_work->duration_type = $validate['duration_type'];
        $about_me_work->date_start = $validate['date_start'];
        $about_me_work->date_end = $validate['date_end'];
        $about_me_work->description = $validate['description'];
        $about_me_work->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully update this data!",
            'data' => $about_me_work
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $about_me_work = AboutMeWork::findOrFail($id);
        $about_me_work->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => "You have successfully delete this data!"]);
    }
}
