<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageContent extends Model
{
    protected $fillable = [
        'hero_eyebrow',
        'hero_title',
        'hero_subtitle',
        'hero_youtube_url',
        'primary_button_label',
        'primary_button_url',
        'secondary_button_label',
        'secondary_button_url',
        'music_eyebrow',
        'music_title',
        'music_cta_label',
        'music_cta_url',
        'tickets_eyebrow',
        'tickets_title',
        'branding_eyebrow',
        'branding_title',
        'branding_description',
        'products_eyebrow',
        'products_title',
        'services_eyebrow',
        'services_title',
        'inquiry_button_label',
        'footer_text',
    ];

    public static function current(): self
    {
        return self::firstOrCreate([], self::defaults());
    }

    public static function defaults(): array
    {
        return [
            'hero_eyebrow' => 'Music. Tickets. Branding.',
            'hero_title' => 'Addeh Prince & Thayu Nation',
            'hero_subtitle' => 'The official platform for upcoming releases, live experiences, and sharp Kenyan branding services for businesses, events, and creative campaigns.',
            'hero_youtube_url' => config('services.hero_youtube_url'),
            'primary_button_label' => 'Watch on YouTube',
            'primary_button_url' => 'https://www.youtube.com/@iamaddehprince',
            'secondary_button_label' => 'Apple Music',
            'secondary_button_url' => 'https://music.apple.com/us/artist/addeh-prince/1689935496',
            'music_eyebrow' => 'Latest music',
            'music_title' => 'Promote every release',
            'music_cta_label' => 'Open video library',
            'music_cta_url' => 'https://www.youtube.com/channel/UCFZGwBiC1KZeWc1FXZieNrA/videos',
            'tickets_eyebrow' => 'Live experiences',
            'tickets_title' => 'Upcoming shows and tickets',
            'branding_eyebrow' => 'Branding by Addeh',
            'branding_title' => 'Custom apparel and brand merchandise',
            'branding_description' => 'From hoodies and launch merch to full identity systems, Thayu Nation creates branded pieces for teams, events, artists, and businesses.',
            'products_eyebrow' => 'Printing & Branding',
            'products_title' => 'Plain branded hoodies',
            'services_eyebrow' => 'Branding services',
            'services_title' => 'Services for teams, events, and campaigns',
            'inquiry_button_label' => 'Send branding inquiry',
            'footer_text' => 'Addeh Prince and Thayu Nation. Built for music, tickets, and Kenyan brand growth.',
        ];
    }

    public static function youtubeVideoId(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $host = parse_url($url, PHP_URL_HOST);
        $path = trim(parse_url($url, PHP_URL_PATH) ?? '', '/');

        if (! $host) {
            return preg_match('/^[A-Za-z0-9_-]{11}$/', $url) ? $url : null;
        }

        if (str_contains($host, 'youtu.be')) {
            return preg_match('/^[A-Za-z0-9_-]{11}$/', $path) ? $path : null;
        }

        if (str_contains($host, 'youtube.com')) {
            if (in_array(str($path)->before('/')->toString(), ['embed', 'shorts', 'live'], true)) {
                $id = str($path)->after('/')->before('/')->toString();

                return preg_match('/^[A-Za-z0-9_-]{11}$/', $id) ? $id : null;
            }

            parse_str(parse_url($url, PHP_URL_QUERY) ?? '', $query);
            $id = $query['v'] ?? null;

            return is_string($id) && preg_match('/^[A-Za-z0-9_-]{11}$/', $id) ? $id : null;
        }

        return null;
    }
}
