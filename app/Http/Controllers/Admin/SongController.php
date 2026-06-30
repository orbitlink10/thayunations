<?php

namespace App\Http\Controllers\Admin;

use App\Models\Song;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.songs.index', ['songs' => Song::latest()->paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.songs.form', ['song' => new Song()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Song::create($this->payload($request));
        return redirect()->route('admin.songs.index')->with('success', 'Song created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.songs.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        return view('admin.songs.form', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        $song->update($this->payload($request, $song));
        return redirect()->route('admin.songs.index')->with('success', 'Song updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        $song->delete();
        return back()->with('success', 'Song deleted.');
    }

    private function payload(Request $request, ?Song $song = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'description' => ['nullable', 'string'],
            'release_date' => ['nullable', 'date'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'apple_music_url' => ['nullable', 'url', 'max:255'],
            'spotify_url' => ['nullable', 'url', 'max:255'],
        ]);

        $data['slug'] = Str::slug($data['title']).'-'.Str::random(5);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published', true);
        if ($song?->exists) {
            $data['slug'] = $song->slug;
        }
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('songs', 'public');
        }

        return $data;
    }
}
