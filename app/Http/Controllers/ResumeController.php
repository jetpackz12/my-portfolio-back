<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{

    const CACHE_KEY = "Resume";
    const CACHE_SECONDS = 60 * 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            return Resume::all();
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => "required",
            'icon' => "required",
            'image' => "required|image|mimes:jpeg,png,jpg|max:5120",
            'file' => "required|mimes:doc,docx,pdf|max:10000",
        ]);

        $data = [];

        $image_path = $request->file('image')->store('images', 'public');

        $file_path = $request->file('file')->store('files', 'public');

        $resume = new Resume();
        $resume->title = $validate['title'];
        $resume->icon = $validate['icon'];
        $resume->image_path = $image_path;
        $resume->file_path = $file_path;
        $resume->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully add new data!",
            'data' => $resume
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $resume = Resume::find($id);

        return response()->json($resume);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => "required",
            'icon' => "required",
            'image' => "nullable|image|mimes:jpeg,png,jpg|max:5120",
            'file' => "nullable|mimes:doc,docx,pdf|max:10000",
        ]);

        $data = [];

        $resume = Resume::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($resume->image_path);
            $image_path = $request->file('image')->store('images', 'public');
            $resume->image_path = $image_path;
        }

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($resume->file_path);
            $file_path = $request->file('file')->store('files', 'public');
            $resume->file_path = $file_path;
        }

        $resume->title = $validate['title'];
        $resume->icon = $validate['icon'];
        $resume->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully update this data!",
            'data' => $resume
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resume = Resume::findOrFail($id);
        Storage::disk('public')->delete($resume->image_path);
        Storage::disk('public')->delete($resume->file_path);
        $resume->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => "You have successfully delete this data!"]);
    }
}
