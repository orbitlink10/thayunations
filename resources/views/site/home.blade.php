@extends('layouts.site')

@section('content')
<header class="fixed inset-x-0 top-0 z-20 border-b border-white/10 bg-zinc-950/80 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6">
        <a href="#" class="text-lg font-black tracking-normal">Addeh Prince</a>
        <nav class="hidden items-center gap-6 text-sm text-zinc-300 md:flex">
            <a href="#music">Music</a><a href="#tickets">Tickets</a><a href="#branding">Thayu Nation</a><a href="{{ route('admin.login') }}">Admin</a>
        </nav>
        <a href="#tickets" class="rounded-md bg-amber-400 px-4 py-2 text-sm font-bold text-zinc-950">Buy tickets</a>
    </div>
</header>

<main>
    <section class="relative min-h-[92vh] overflow-hidden pt-24">
        <img src="{{ asset('images/addeh-thayu-hero.png') }}" alt="Music and branding studio campaign visual" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-zinc-950 via-zinc-950/80 to-zinc-950/25"></div>
        <div class="relative mx-auto grid min-h-[78vh] max-w-7xl items-center px-4 py-16 sm:px-6 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <p class="mb-4 text-sm font-bold uppercase tracking-[0.25em] text-amber-300">Music. Tickets. Branding.</p>
                <h1 class="max-w-3xl text-5xl font-black leading-none sm:text-7xl">Addeh Prince & Thayu Nation</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-zinc-200">The official platform for upcoming releases, live experiences, and sharp Kenyan branding services for businesses, events, and creative campaigns.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="https://www.youtube.com/@iamaddehprince" target="_blank" class="rounded-md bg-white px-5 py-3 font-bold text-zinc-950">Watch on YouTube</a>
                    <a href="https://music.apple.com/us/artist/addeh-prince/1689935496" target="_blank" class="rounded-md border border-white/30 px-5 py-3 font-bold text-white">Apple Music</a>
                </div>
            </div>
        </div>
    </section>

    @if(session('success'))<div class="mx-auto mt-8 max-w-7xl px-4 sm:px-6"><div class="rounded-md bg-emerald-400 px-5 py-4 font-bold text-emerald-950">{{ session('success') }}</div></div>@endif

    <section id="music" class="mx-auto max-w-7xl px-4 py-20 sm:px-6">
        <div class="mb-10 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div><p class="text-sm font-bold uppercase tracking-[0.2em] text-amber-300">Latest music</p><h2 class="mt-2 text-4xl font-black">Promote every release</h2></div>
            <a href="https://www.youtube.com/channel/UCFZGwBiC1KZeWc1FXZieNrA/videos" target="_blank" class="text-sm font-bold text-amber-300">Open video library</a>
        </div>
        <div class="grid gap-5 md:grid-cols-3">
            @forelse($songs as $song)
                <article class="rounded-lg border border-white/10 bg-white/[0.04] p-5">
                    <div class="mb-5 aspect-square rounded-md bg-gradient-to-br from-zinc-800 to-emerald-900/60 @if($song->cover_image) bg-cover bg-center @endif" @if($song->cover_image) style="background-image:url('{{ asset('storage/'.$song->cover_image) }}')" @endif></div>
                    <p class="text-sm text-zinc-400">{{ optional($song->release_date)->format('M d, Y') ?? 'Coming soon' }}</p>
                    <h3 class="mt-1 text-2xl font-black">{{ $song->title }}</h3>
                    <p class="mt-3 text-sm leading-6 text-zinc-300">{{ $song->description }}</p>
                    <div class="mt-5 flex flex-wrap gap-2 text-sm font-bold">
                        @if($song->youtube_url)<a target="_blank" class="rounded-md bg-red-500 px-3 py-2" href="{{ $song->youtube_url }}">YouTube</a>@endif
                        @if($song->apple_music_url)<a target="_blank" class="rounded-md bg-zinc-800 px-3 py-2" href="{{ $song->apple_music_url }}">Apple Music</a>@endif
                    </div>
                </article>
            @empty
                <p class="text-zinc-300">No songs have been published yet.</p>
            @endforelse
        </div>
    </section>

    <section id="tickets" class="bg-white py-20 text-zinc-950">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-emerald-700">Live experiences</p>
            <h2 class="mt-2 text-4xl font-black">Upcoming shows and tickets</h2>
            <div class="mt-10 grid gap-6 lg:grid-cols-2">
                @foreach($events as $event)
                    <article class="rounded-lg border border-zinc-200 p-6">
                        <p class="text-sm font-bold text-emerald-700">{{ $event->event_date->format('D, M d, Y - g:i A') }}</p>
                        <h3 class="mt-2 text-3xl font-black">{{ $event->title }}</h3>
                        <p class="mt-2 text-zinc-600">{{ $event->venue }}, {{ $event->city }}</p>
                        <p class="mt-4 text-zinc-700">{{ $event->description }}</p>
                        <p class="mt-5 text-xl font-black">KSh {{ number_format($event->ticket_price) }}</p>
                        <form method="POST" action="{{ route('tickets.store', $event) }}" class="mt-5 grid gap-3">
                            @csrf
                            <input name="customer_name" placeholder="Full name" class="field" required>
                            <input name="email" type="email" placeholder="Email address" class="field" required>
                            <input name="phone" placeholder="Phone / M-Pesa number" class="field" required>
                            <div class="grid gap-3 sm:grid-cols-2"><input name="quantity" type="number" min="1" max="10" value="1" class="field"><input name="payment_reference" placeholder="Payment reference" class="field"></div>
                            <button class="rounded-md bg-zinc-950 px-5 py-3 font-bold text-white">Reserve ticket</button>
                        </form>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="branding" class="mx-auto max-w-7xl px-4 py-20 sm:px-6">
        <div class="grid gap-10 lg:grid-cols-[0.8fr_1.2fr]">
            <div><p class="text-sm font-bold uppercase tracking-[0.2em] text-amber-300">Thayu Nation</p><h2 class="mt-2 text-4xl font-black">Branding services in Kenya</h2><p class="mt-5 leading-8 text-zinc-300">From identity systems to launch materials, Thayu Nation helps businesses and creatives look serious across print, merchandise, events, and digital campaigns.</p></div>
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach($services as $service)
                    <article class="rounded-lg border border-white/10 bg-white/[0.04] p-5">
                        <p class="text-sm font-bold uppercase text-amber-300">{{ $service->icon }}</p>
                        <h3 class="mt-3 text-xl font-black">{{ $service->name }}</h3>
                        <p class="mt-3 text-sm leading-6 text-zinc-300">{{ $service->description }}</p>
                        @if($service->starting_price)<p class="mt-4 font-bold">From KSh {{ number_format($service->starting_price) }}</p>@endif
                    </article>
                @endforeach
            </div>
        </div>
        <form method="POST" action="{{ route('inquiries.store') }}" class="mt-12 grid gap-3 rounded-lg bg-white p-5 text-zinc-950 md:grid-cols-2">
            @csrf
            <input name="name" placeholder="Your name" class="field" required>
            <input name="email" type="email" placeholder="Email address" class="field" required>
            <input name="phone" placeholder="Phone number" class="field">
            <input name="company" placeholder="Business / company" class="field">
            <select name="branding_service_id" class="field md:col-span-2"><option value="">Select service</option>@foreach($services as $service)<option value="{{ $service->id }}">{{ $service->name }}</option>@endforeach</select>
            <textarea name="message" rows="5" placeholder="Tell us what you need branded" class="field md:col-span-2" required></textarea>
            <button class="rounded-md bg-amber-400 px-5 py-3 font-bold text-zinc-950 md:col-span-2">Send branding inquiry</button>
        </form>
    </section>
</main>

<footer class="border-t border-white/10 px-4 py-8 text-center text-sm text-zinc-400">Addeh Prince and Thayu Nation. Built for music, tickets, and Kenyan brand growth.</footer>
@endsection
