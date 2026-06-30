@extends('layouts.admin')

@section('content')
<div class="toolbar">
    <div>
        <h1 class="text-3xl font-black">Homepage Content</h1>
        <p class="mt-1 text-zinc-500">Update the homepage hero text, buttons, and YouTube background video.</p>
    </div>
    <a class="btn" href="{{ route('home') }}" target="_blank">View homepage</a>
</div>

<form method="POST" action="{{ route('admin.homepage-content.update') }}" class="form-panel">
    @csrf
    @method('PUT')

    @include('admin.shared.errors')

    <div>
        <label class="mb-2 block text-sm font-bold text-zinc-700">Small heading</label>
        <input class="field" name="hero_eyebrow" value="{{ old('hero_eyebrow', $content->hero_eyebrow) }}" placeholder="Music. Tickets. Branding.">
    </div>

    <div>
        <label class="mb-2 block text-sm font-bold text-zinc-700">Main title</label>
        <input class="field" name="hero_title" value="{{ old('hero_title', $content->hero_title) }}" required>
    </div>

    <div>
        <label class="mb-2 block text-sm font-bold text-zinc-700">Intro text</label>
        <textarea class="field" name="hero_subtitle" rows="4">{{ old('hero_subtitle', $content->hero_subtitle) }}</textarea>
    </div>

    <section class="rounded-lg border border-zinc-200 bg-zinc-50 p-4">
        <h2 class="text-lg font-black">Background video</h2>
        <div class="mt-4">
            <label class="mb-2 block text-sm font-bold text-zinc-700">YouTube URL</label>
            <input class="field" name="hero_youtube_url" type="url" value="{{ old('hero_youtube_url', $content->hero_youtube_url) }}" placeholder="https://www.youtube.com/watch?v=VIDEO_ID">
        </div>
    </section>

    <section class="grid gap-4 rounded-lg border border-zinc-200 bg-zinc-50 p-4 md:grid-cols-2">
        <div class="md:col-span-2">
            <h2 class="text-lg font-black">Hero buttons</h2>
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Primary button label</label>
            <input class="field" name="primary_button_label" value="{{ old('primary_button_label', $content->primary_button_label) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Primary button URL</label>
            <input class="field" name="primary_button_url" type="url" value="{{ old('primary_button_url', $content->primary_button_url) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Secondary button label</label>
            <input class="field" name="secondary_button_label" value="{{ old('secondary_button_label', $content->secondary_button_label) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Secondary button URL</label>
            <input class="field" name="secondary_button_url" type="url" value="{{ old('secondary_button_url', $content->secondary_button_url) }}">
        </div>
    </section>

    <button class="btn">Save homepage content</button>
</form>
@endsection
