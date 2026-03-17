<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    const CACHE_KEY = "Project";
    const CACHE_SECONDS = 60 * 5;
    const MODULE_TYPE_PROJECT = 3;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            $project = Project::all();
            $project = collect($project)->map(function ($item) {
                $item->images = Image::where('module_id', $item->id)
                    ->select("image_path")
                    ->where('images.module_type', self::MODULE_TYPE_PROJECT)
                    ->pluck('image_path')
                    ->toArray();
                return $item;
            });

            return $project;
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
            'description' => "required",
            'repository' => "nullable",
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = [];

        $project = new Project();
        $project->title = $validate['title'];
        $project->description = $validate['description'];
        $project->repository = $validate['repository'];
        $project->save();


        foreach ($request->file('image') as $file) {
            $path = $file->store('images', 'public');

            $image = new Image();
            $image->module_type = self::MODULE_TYPE_PROJECT;
            $image->module_id = $project->id;
            $image->image_path = $path;
            $image->save();
        }

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have succcessfully add new data!",
            'data' => [$project]
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'project' => Project::find($id),
            'image' => Image::where('module_type', self::MODULE_TYPE_PROJECT)
                ->where('module_id', $id)
                ->get(),
        ];

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => "required",
            'description' => "required",
            'repository' => "nullable",
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = [];

        $project = Project::findOrFail($id);
        $project->title = $validate['title'];
        $project->description = $validate['description'];
        $project->repository = $validate['repository'];
        $project->save();

        if ($request->hasFile('image')) {

            $image = Image::where('module_type', self::MODULE_TYPE_PROJECT)->where('module_id', $id);

            foreach ($image->get() as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }

            foreach ($request->file('image') as $file) {
                $path = $file->store('images', 'public');

                $image = new Image();
                $image->module_type = self::MODULE_TYPE_PROJECT;
                $image->module_id = $project->id;
                $image->image_path = $path;
                $image->save();
            }
        }

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have succcessfully update this data!",
            'data' => [$project]
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $image = Image::where('module_type', self::MODULE_TYPE_PROJECT)->where('module_id', $id);
        $project = Project::findOrFail($id);

        foreach ($image->get() as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $image->delete();
        $project->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => "You have successfully delete this data!"]);
    }
}
