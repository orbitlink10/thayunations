@extends('layouts.admin')
@section('content')
<h1 class="text-3xl font-black">{{ $song->exists ? 'Edit song' : 'New song' }}</h1>
<form method="POST" enctype="multipart/form-data" action="{{ $song->exists ? route('admin.songs.update',$song) : route('admin.songs.store') }}" class="form-panel">
    @csrf @if($song->exists) @method('PUT') @endif
    @include('admin.shared.errors')
    <input class="field" name="title" placeholder="Song title" value="{{ old('title',$song->title) }}" required>
    <textarea class="field" name="description" rows="4" placeholder="Description">{{ old('description',$song->description) }}</textarea>
    <input class="field" name="release_date" type="date" value="{{ old('release_date', optional($song->release_date)->format('Y-m-d')) }}">
    <input class="field" name="cover_image" type="file" accept="image/*">
    <input class="field" name="youtube_url" placeholder="YouTube URL" value="{{ old('youtube_url',$song->youtube_url) }}">
    <input class="field" name="apple_music_url" placeholder="Apple Music URL" value="{{ old('apple_music_url',$song->apple_music_url) }}">
    <input class="field" name="spotify_url" placeholder="Spotify URL" value="{{ old('spotify_url',$song->spotify_url) }}">
    <label class="check"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured',$song->is_featured))> Featured release</label>
    <label class="check"><input type="checkbox" name="is_published" value="1" @checked(old('is_published',$song->is_published ?? true))> Published</label>
    <button class="btn">{{ $song->exists ? 'Save song' : 'Create song' }}</button>
</form>
@endsection
