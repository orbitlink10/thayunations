<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('homepage_contents', function (Blueprint $table) {
            $table->string('music_eyebrow')->nullable()->after('secondary_button_url');
            $table->string('music_title')->nullable()->after('music_eyebrow');
            $table->string('music_cta_label')->nullable()->after('music_title');
            $table->string('music_cta_url')->nullable()->after('music_cta_label');
            $table->string('tickets_eyebrow')->nullable()->after('music_cta_url');
            $table->string('tickets_title')->nullable()->after('tickets_eyebrow');
            $table->string('branding_eyebrow')->nullable()->after('tickets_title');
            $table->string('branding_title')->nullable()->after('branding_eyebrow');
            $table->text('branding_description')->nullable()->after('branding_title');
            $table->string('products_eyebrow')->nullable()->after('branding_description');
            $table->string('products_title')->nullable()->after('products_eyebrow');
            $table->string('services_eyebrow')->nullable()->after('products_title');
            $table->string('services_title')->nullable()->after('services_eyebrow');
            $table->string('inquiry_button_label')->nullable()->after('services_title');
            $table->string('footer_text')->nullable()->after('inquiry_button_label');
        });

        DB::table('homepage_contents')->update([
            'music_eyebrow' => 'Watch the releases',
            'music_title' => 'Featured Music.',
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
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homepage_contents', function (Blueprint $table) {
            $table->dropColumn([
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
            ]);
        });
    }
};
