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

<section class="panel mt-6">
    <div class="toolbar">
        <div>
            <h2 class="text-2xl font-black">Music release cards</h2>
            <p class="mt-1 text-zinc-500">Edit the songs that appear under the music section on the homepage.</p>
        </div>
        <a class="btn" href="{{ route('admin.songs.create') }}">New song</a>
    </div>

    <div class="mt-5 grid gap-4 lg:grid-cols-2">
        @forelse($songs as $song)
            <article class="rounded-lg border border-zinc-200 bg-white p-4">
                <div class="flex gap-4">
                    <div
                        class="h-24 w-24 shrink-0 rounded-md bg-gradient-to-br from-zinc-200 to-emerald-900/40 bg-cover bg-center"
                        @if($song->cover_image) style="background-image:url('{{ asset('storage/'.$song->cover_image) }}')" @endif
                    ></div>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <h3 class="text-xl font-black">{{ $song->title }}</h3>
                            @if($song->is_featured)
                                <span class="rounded-full bg-amber-100 px-2 py-1 text-xs font-bold text-amber-800">Featured</span>
                            @endif
                            @unless($song->is_published)
                                <span class="rounded-full bg-zinc-100 px-2 py-1 text-xs font-bold text-zinc-600">Hidden</span>
                            @endunless
                        </div>
                        <p class="mt-1 text-sm text-zinc-500">{{ optional($song->release_date)->format('M d, Y') ?? 'No release date' }}</p>
                        <p class="mt-2 line-clamp-2 text-sm text-zinc-600">{{ $song->description ?: 'No description added.' }}</p>
                        <div class="mt-4 flex flex-wrap gap-3 text-sm font-bold">
                            <a class="text-emerald-700" href="{{ route('admin.songs.edit', $song) }}">Edit song</a>
                            <a class="text-zinc-600" href="{{ route('admin.songs.index') }}">Manage all songs</a>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-lg border border-dashed border-zinc-300 bg-white p-6 text-zinc-500">
                No songs have been added yet. Create a song to show it in this homepage section.
            </div>
        @endforelse
    </div>
</section>
@endsection
