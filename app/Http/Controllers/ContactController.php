<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{

    const CACHE_KEY = "Contact";
    const CACHE_SECONDS = 60 * 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
            return Contact::all();
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|unique:contacts,title',
            'sub_title' => 'required',
            'icon' => 'required'
        ]);

        $data = [];

        $contact = new Contact();
        $contact->title = $validate['title'];
        $contact->sub_title = $validate['sub_title'];
        $contact->icon = $validate['icon'];
        $contact->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully add new data!",
            'data' => $contact
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contact = Contact::find($id);

        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'required|unique:contacts,title,'.$id,
            'sub_title' => 'required',
            'icon' => 'required'
        ]);

        $data = [];

        $contact = Contact::findOrFail($id);
        $contact->title = $validate['title'];
        $contact->sub_title = $validate['sub_title'];
        $contact->icon = $validate['icon'];
        $contact->save();

        Cache::forget(self::CACHE_KEY);

        $data = [
            'message' => "You have successfully update this data!",
            'data' => $contact
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        Cache::forget(self::CACHE_KEY);

        return response()->json(['message'=>"You have successfully delete this data!"]);
    }
}
