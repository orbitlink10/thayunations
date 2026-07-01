@extends('layouts.admin')

@section('content')
<div class="toolbar">
    <div>
        <h1 class="text-3xl font-black">Homepage Content</h1>
        <p class="mt-1 text-zinc-500">Update homepage hero text, section headings, buttons, and footer copy.</p>
    </div>
    <a class="btn" href="{{ route('home') }}" target="_blank">View homepage</a>
</div>

<form method="POST" action="{{ route('admin.homepage-content.update') }}" class="form-panel">
    @csrf
    @method('PUT')

    @include('admin.shared.errors')

    <section class="grid gap-4 rounded-lg border border-zinc-200 bg-zinc-50 p-4">
        <h2 class="text-lg font-black">Hero</h2>
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
    </section>

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

    <section class="grid gap-4 rounded-lg border border-zinc-200 bg-zinc-50 p-4 md:grid-cols-2">
        <div class="md:col-span-2">
            <h2 class="text-lg font-black">Music section</h2>
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Small heading</label>
            <input class="field" name="music_eyebrow" value="{{ old('music_eyebrow', $content->music_eyebrow) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Main heading</label>
            <input class="field" name="music_title" value="{{ old('music_title', $content->music_title) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">CTA label</label>
            <input class="field" name="music_cta_label" value="{{ old('music_cta_label', $content->music_cta_label) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">CTA URL</label>
            <input class="field" name="music_cta_url" type="url" value="{{ old('music_cta_url', $content->music_cta_url) }}">
        </div>
    </section>

    <section class="grid gap-4 rounded-lg border border-zinc-200 bg-zinc-50 p-4 md:grid-cols-2">
        <div class="md:col-span-2">
            <h2 class="text-lg font-black">Tickets section</h2>
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Small heading</label>
            <input class="field" name="tickets_eyebrow" value="{{ old('tickets_eyebrow', $content->tickets_eyebrow) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Main heading</label>
            <input class="field" name="tickets_title" value="{{ old('tickets_title', $content->tickets_title) }}">
        </div>
    </section>

    <section class="grid gap-4 rounded-lg border border-zinc-200 bg-zinc-50 p-4 md:grid-cols-2">
        <div class="md:col-span-2">
            <h2 class="text-lg font-black">Branding section</h2>
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Small heading</label>
            <input class="field" name="branding_eyebrow" value="{{ old('branding_eyebrow', $content->branding_eyebrow) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Main heading</label>
            <input class="field" name="branding_title" value="{{ old('branding_title', $content->branding_title) }}">
        </div>
        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-bold text-zinc-700">Description</label>
            <textarea class="field" name="branding_description" rows="4">{{ old('branding_description', $content->branding_description) }}</textarea>
        </div>
    </section>

    <section class="grid gap-4 rounded-lg border border-zinc-200 bg-zinc-50 p-4 md:grid-cols-2">
        <div class="md:col-span-2">
            <h2 class="text-lg font-black">Product and service headings</h2>
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Products small heading</label>
            <input class="field" name="products_eyebrow" value="{{ old('products_eyebrow', $content->products_eyebrow) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Products heading</label>
            <input class="field" name="products_title" value="{{ old('products_title', $content->products_title) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Services small heading</label>
            <input class="field" name="services_eyebrow" value="{{ old('services_eyebrow', $content->services_eyebrow) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Services heading</label>
            <input class="field" name="services_title" value="{{ old('services_title', $content->services_title) }}">
        </div>
    </section>

    <section class="grid gap-4 rounded-lg border border-zinc-200 bg-zinc-50 p-4 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Inquiry button label</label>
            <input class="field" name="inquiry_button_label" value="{{ old('inquiry_button_label', $content->inquiry_button_label) }}">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-zinc-700">Footer text</label>
            <input class="field" name="footer_text" value="{{ old('footer_text', $content->footer_text) }}">
        </div>
    </section>

    <button class="btn">Save homepage content</button>
</form>
@endsection
