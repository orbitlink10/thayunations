<?php

namespace Database\Seeders;

use App\Models\BrandingService;
use App\Models\Event;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@thayunation.co.ke'], [
            'name' => 'Addeh Prince Admin',
            'password' => Hash::make('Admin@12345'),
        ]);

        Song::updateOrCreate(['slug' => 'kijiti'], [
            'title' => 'Kijiti',
            'description' => 'Featured Addeh Prince release promoted from the official streaming catalog.',
            'release_date' => '2024-10-25',
            'youtube_url' => 'https://www.youtube.com/@iamaddehprince',
            'apple_music_url' => 'https://music.apple.com/us/artist/addeh-prince/1689935496',
            'is_featured' => true,
            'is_published' => true,
        ]);

        Song::updateOrCreate(['slug' => 'nyota'], [
            'title' => 'Nyota',
            'description' => 'A catalog highlight ready for promotion, video embeds, and streaming links.',
            'release_date' => '2024-01-12',
            'youtube_url' => 'https://www.youtube.com/channel/UCFZGwBiC1KZeWc1FXZieNrA/videos',
            'apple_music_url' => 'https://music.apple.com/us/artist/addeh-prince/1689935496',
            'is_published' => true,
        ]);

        Event::updateOrCreate(['slug' => 'addeh-prince-live-nairobi'], [
            'title' => 'Addeh Prince Live in Nairobi',
            'description' => 'A live music experience with limited advance tickets. Replace this sample with the confirmed venue and date from the admin dashboard.',
            'event_date' => now()->addMonth()->setTime(18, 30),
            'venue' => 'Nairobi Creative Hub',
            'city' => 'Nairobi',
            'ticket_price' => 1500,
            'tickets_available' => 200,
            'is_published' => true,
        ]);

        foreach ([
            ['Logo & Brand Identity', 'Logos, stationery, visual systems, and brand guidelines for Kenyan businesses.', 'palette', 25000],
            ['Print & Merchandise', 'Business cards, banners, t-shirts, caps, packaging, and event merchandise.', 'shirt', 1200],
            ['Digital Campaign Design', 'Social media artwork, posters, launch creatives, and paid-ad visuals.', 'megaphone', 8000],
        ] as [$name, $description, $icon, $price]) {
            BrandingService::updateOrCreate(['slug' => str($name)->slug()->toString()], [
                'name' => $name,
                'description' => $description,
                'icon' => $icon,
                'starting_price' => $price,
                'is_published' => true,
            ]);
        }
    }
}
