<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();

        return response()->json($photos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required',
            'tags' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public/images');

        $photo = Photo::create([
            'user_id' => auth()->user()->id,
            'caption' => $request->caption,
            'tags' => $request->tags,
            'image' => Storage::url($imagePath),
        ]);

        return response()->json(['message' => 'Photo uploaded successfully', 'data' => $photo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::findOrFail($id);

        return response()->json($photo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);

        if ($photo->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'caption' => 'required',
            'tags' => 'required',
        ]);

        $photo->update([
            'caption' => $request->caption,
            'tags' => $request->tags,
        ]);

        return response()->json(['message' => 'Photo updated successfully', 'data' => $photo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        if ($photo->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $photo->delete();

        return response()->json(['message' => 'Photo deleted successfully', 'data' => $photo]);
    }

    public function like($id)
    {
        $photo = Photo::findOrFail($id);

        $photo->like(auth()->user());

        return response()->json(['message' => 'Photo liked successfully', 'data' => $photo]);
    }

    public function unlike($id)
    {
        $photo = Photo::findOrFail($id);

        $photo->unlike(auth()->user());

        return response()->json(['message' => 'Like deleted successfully', 'data' => $photo]);
    }
}
