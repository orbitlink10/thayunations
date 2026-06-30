<?php

namespace App\Http\Controllers;

use App\Models\BrandingService;
use App\Models\Event;
use App\Models\Inquiry;
use App\Models\Song;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        $heroYoutubeUrl = config('services.hero_youtube_url');

        return view('site.home', [
            'featuredSong' => Song::where('is_published', true)->where('is_featured', true)->latest('release_date')->first(),
            'songs' => Song::where('is_published', true)->latest('release_date')->take(6)->get(),
            'events' => Event::where('is_published', true)->where('event_date', '>=', now())->orderBy('event_date')->take(4)->get(),
            'services' => BrandingService::where('is_published', true)->latest()->get(),
            'heroYoutubeId' => $heroYoutubeUrl ? $this->youtubeVideoId($heroYoutubeUrl) : null,
        ]);
    }

    private function youtubeVideoId(string $url): ?string
    {
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

    public function buyTicket(Request $request, Event $event)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:40'],
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
            'payment_reference' => ['nullable', 'string', 'max:120'],
        ]);

        $data['unit_price'] = $event->ticket_price;
        $data['total_amount'] = $event->ticket_price * $data['quantity'];
        $data['status'] = 'pending';
        $event->ticketOrders()->create($data);

        return back()->with('success', 'Ticket request received. The team will confirm payment and send your ticket details.');
    }

    public function inquiry(Request $request)
    {
        Inquiry::create($request->validate([
            'branding_service_id' => ['nullable', 'exists:branding_services,id'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'company' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:2000'],
        ]));

        return back()->with('success', 'Branding inquiry sent. Thayu Nation will get back to you.');
    }
}
