<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageContent;
use App\Models\Song;
use Illuminate\Http\Request;

class HomepageContentController extends Controller
{
    public function edit()
    {
        return view('admin.homepage-content.edit', [
            'content' => HomepageContent::current(),
            'songs' => Song::latest('release_date')->latest()->take(6)->get(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_eyebrow' => ['nullable', 'string', 'max:120'],
            'hero_title' => ['required', 'string', 'max:160'],
            'hero_subtitle' => ['nullable', 'string', 'max:500'],
            'hero_youtube_url' => ['nullable', 'url', 'max:255'],
            'primary_button_label' => ['nullable', 'string', 'max:80'],
            'primary_button_url' => ['nullable', 'url', 'max:255'],
            'secondary_button_label' => ['nullable', 'string', 'max:80'],
            'secondary_button_url' => ['nullable', 'url', 'max:255'],
            'music_eyebrow' => ['nullable', 'string', 'max:120'],
            'music_title' => ['nullable', 'string', 'max:160'],
            'music_cta_label' => ['nullable', 'string', 'max:80'],
            'music_cta_url' => ['nullable', 'url', 'max:255'],
            'tickets_eyebrow' => ['nullable', 'string', 'max:120'],
            'tickets_title' => ['nullable', 'string', 'max:160'],
            'branding_eyebrow' => ['nullable', 'string', 'max:120'],
            'branding_title' => ['nullable', 'string', 'max:160'],
            'branding_description' => ['nullable', 'string', 'max:500'],
            'products_eyebrow' => ['nullable', 'string', 'max:120'],
            'products_title' => ['nullable', 'string', 'max:160'],
            'services_eyebrow' => ['nullable', 'string', 'max:120'],
            'services_title' => ['nullable', 'string', 'max:160'],
            'inquiry_button_label' => ['nullable', 'string', 'max:80'],
            'footer_text' => ['nullable', 'string', 'max:255'],
        ]);

        if (! empty($data['hero_youtube_url']) && ! HomepageContent::youtubeVideoId($data['hero_youtube_url'])) {
            return back()
                ->withErrors(['hero_youtube_url' => 'Enter a valid YouTube video URL.'])
                ->withInput();
        }

        HomepageContent::current()->update($data);

        return redirect()->route('admin.homepage-content.edit')->with('success', 'Homepage content updated.');
    }
}
