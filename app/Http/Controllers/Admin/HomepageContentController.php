<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageContent;
use Illuminate\Http\Request;

class HomepageContentController extends Controller
{
    public function edit()
    {
        return view('admin.homepage-content.edit', [
            'content' => HomepageContent::current(),
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
