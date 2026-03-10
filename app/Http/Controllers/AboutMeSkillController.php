<?php

namespace App\Http\Controllers;

use App\Models\AboutMeSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AboutMeSkillController extends Controller
{

    const CACHE_KEY = "AboutMeSkill";
    const CACHE_SECONDS = 60 * 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            return AboutMeSkill::all();
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => "required|unique:about_me_skills,title",
            'skills' => "required"
        ]);

        $data = [];

        $about_me_skill = new AboutMeSkill();
        $about_me_skill->title = $validate['title'];
        $about_me_skill->skills = $validate['skills'];
        $about_me_skill->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have succcessfully add new data!",
            'data' => $about_me_skill
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $about_me_skill = AboutMeSkill::findOrFail($id);

        return response()->json($about_me_skill);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => "required|unique:about_me_skills,title," . $id,
            'skills' => "required"
        ]);

        $data = [];

        $about_me_skill = AboutMeSkill::findOrFail($id);
        $about_me_skill->title = $validate['title'];
        $about_me_skill->skills = $validate['skills'];
        $about_me_skill->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully update this data!",
            'data' => $about_me_skill
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $about_me_skill = AboutMeSkill::findOrFail($id);
        $about_me_skill->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => "You have successfully delete this data!"]);
    }
}
