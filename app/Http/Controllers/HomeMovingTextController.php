<?php

namespace App\Http\Controllers;

use App\Models\HomeMovingText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeMovingTextController extends Controller
{

    const CACHE_KEY = "HomeMovingText";
    const CACHE_SECONDS = 60 * 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            return HomeMovingText::all();
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'text' => "required|unique:home_moving_texts,text"
        ]);

        $data = [];

        $home_moving_text = new HomeMovingText();
        $home_moving_text->text = $validate['text'];
        $home_moving_text->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully add new data!",
            'data' => $home_moving_text
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = HomeMovingText::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'text' => "required|unique:home_moving_texts,text," . $id
        ]);

        $data = [];

        $home_moving_text = HomeMovingText::findOrFail($id);
        $home_moving_text->text = $validate['text'];
        $home_moving_text->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully update this data!",
            'data' => $home_moving_text
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $home_moving_text = HomeMovingText::findOrFail($id);
        $home_moving_text->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => "You have successfully delete this data!"]);
    }
}
