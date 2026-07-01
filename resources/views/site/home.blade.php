@extends('layouts.site')

@section('content')
<header class="fixed inset-x-0 top-0 z-20">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6">
        <a href="#" class="text-lg font-black tracking-normal">Addeh Prince</a>
        <nav class="hidden items-center gap-6 text-sm text-zinc-300 md:flex">
            <a href="#music">Music</a><a href="#tickets">Tickets</a><a href="#branding">Thayu Nation</a><a href="{{ route('admin.login') }}">Admin</a>
        </nav>
        <div class="flex items-center gap-2">
            <a href="#tickets" class="rounded-md bg-amber-400 px-4 py-2 text-sm font-bold text-zinc-950">Buy tickets</a>
            <a href="#branding" class="rounded-md border border-white/20 px-4 py-2 text-sm font-bold text-white transition hover:border-amber-300 hover:text-amber-300">Branding by Addeh</a>
        </div>
    </div>
</header>

<main>
    <section class="relative min-h-screen overflow-hidden">
        @if($heroYoutubeId)
            <div class="absolute inset-0 overflow-hidden bg-zinc-950" aria-hidden="true">
                <iframe
                    class="pointer-events-none absolute left-1/2 top-1/2 border-0"
                    style="width: max(240vw, 426.67vh); height: max(135vw, 240vh); transform: translate(-50%, -50%);"
                    src="https://www.youtube.com/embed/{{ $heroYoutubeId }}?autoplay=1&mute=1&controls=0&loop=1&playlist={{ $heroYoutubeId }}&playsinline=1&rel=0&modestbranding=1&iv_load_policy=3&disablekb=1"
                    title="Hero background video"
                    allow="autoplay; encrypted-media; picture-in-picture"
                    tabindex="-1"
                ></iframe>
            </div>
        @else
            <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline preload="metadata" poster="{{ asset('images/addeh-thayu-hero.png') }}" aria-hidden="true">
                <source src="{{ asset('videos/hero-video.mp4') }}" type="video/mp4">
            </video>
        @endif
        <div class="absolute inset-0 bg-zinc-950/35"></div>
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-zinc-950 via-zinc-950/35 to-transparent"></div>
        <div class="relative mx-auto flex min-h-screen max-w-7xl items-center justify-center px-4 pb-16 pt-28 text-center sm:px-6">
            <div class="max-w-4xl">
                @if($homepageContent->hero_eyebrow)
                    <p class="mb-4 text-sm font-bold uppercase tracking-[0.25em] text-amber-300">{{ $homepageContent->hero_eyebrow }}</p>
                @endif
                <h1 class="text-5xl font-black leading-none sm:text-7xl">{{ $homepageContent->hero_title }}</h1>
                @if($homepageContent->hero_subtitle)
                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-zinc-100">{{ $homepageContent->hero_subtitle }}</p>
                @endif
                @if(($homepageContent->primary_button_label && $homepageContent->primary_button_url) || ($homepageContent->secondary_button_label && $homepageContent->secondary_button_url))
                    <div class="mt-8 flex flex-wrap justify-center gap-3">
                        @if($homepageContent->primary_button_label && $homepageContent->primary_button_url)
                            <a href="{{ $homepageContent->primary_button_url }}" target="_blank" class="rounded-md bg-white px-5 py-3 font-bold text-zinc-950">{{ $homepageContent->primary_button_label }}</a>
                        @endif
                        @if($homepageContent->secondary_button_label && $homepageContent->secondary_button_url)
                            <a href="{{ $homepageContent->secondary_button_url }}" target="_blank" class="rounded-md border border-white/40 bg-white/10 px-5 py-3 font-bold text-white backdrop-blur">{{ $homepageContent->secondary_button_label }}</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if(session('success'))<div class="mx-auto mt-8 max-w-7xl px-4 sm:px-6"><div class="rounded-md bg-emerald-400 px-5 py-4 font-bold text-emerald-950">{{ session('success') }}</div></div>@endif

    <section id="music" class="mx-auto max-w-7xl px-4 py-20 sm:px-6">
        @php($musicTitle = $homepageContent->music_title ?: 'Featured Music.')
        <div class="mb-10 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                @if($homepageContent->music_eyebrow)
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-amber-300">{{ $homepageContent->music_eyebrow }}</p>
                @endif
                <h2 class="mt-2 text-5xl font-black leading-none sm:text-6xl">{{ $musicTitle }}</h2>
            </div>
            @if($homepageContent->music_cta_label && $homepageContent->music_cta_url)
                <a href="{{ $homepageContent->music_cta_url }}" target="_blank" class="text-sm font-bold text-amber-300">{{ $homepageContent->music_cta_label }}</a>
            @endif
        </div>
        <div class="grid gap-5 md:grid-cols-3">
            @forelse($songs as $song)
                <article class="rounded-lg border border-white/10 bg-white/[0.04] p-5">
                    @php($songYoutubeId = \App\Models\HomepageContent::youtubeVideoId($song->youtube_url))
                    <div class="mb-5 aspect-square overflow-hidden rounded-md bg-gradient-to-br from-zinc-800 to-emerald-900/60 @if($song->cover_image && ! $songYoutubeId) bg-cover bg-center @endif" @if($song->cover_image && ! $songYoutubeId) style="background-image:url('{{ asset('storage/'.$song->cover_image) }}')" @endif>
                        @if($songYoutubeId)
                            <iframe
                                class="h-full w-full border-0"
                                src="https://www.youtube.com/embed/{{ $songYoutubeId }}?rel=0&modestbranding=1"
                                title="{{ $song->title }} video"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                            ></iframe>
                        @endif
                    </div>
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
            @if($homepageContent->tickets_eyebrow)
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-emerald-700">{{ $homepageContent->tickets_eyebrow }}</p>
            @endif
            @if($homepageContent->tickets_title)
                <h2 class="mt-2 text-4xl font-black">{{ $homepageContent->tickets_title }}</h2>
            @endif
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

    <section id="branding" class="bg-white py-20 text-zinc-950">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-10 flex flex-col justify-between gap-4 border-b border-zinc-200 pb-6 md:flex-row md:items-end">
                <div>
                    @if($homepageContent->branding_eyebrow)
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-zinc-500">{{ $homepageContent->branding_eyebrow }}</p>
                    @endif
                    @if($homepageContent->branding_title)
                        <h2 class="mt-2 text-4xl font-black">{{ $homepageContent->branding_title }}</h2>
                    @endif
                </div>
                @if($homepageContent->branding_description)
                    <p class="max-w-xl leading-7 text-zinc-600">{{ $homepageContent->branding_description }}</p>
                @endif
            </div>

            <div>
                <div class="mb-6">
                    @if($homepageContent->products_eyebrow)
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-rose-500">{{ $homepageContent->products_eyebrow }}</p>
                    @endif
                    @if($homepageContent->products_title)
                        <h3 class="mt-2 text-3xl font-black">{{ $homepageContent->products_title }}</h3>
                    @endif
                </div>
                <div class="grid gap-7 lg:grid-cols-3">
                    @foreach([
                        ['name' => 'Red Hoodie', 'description' => 'Branded Plain Hoodie - Fleece', 'price' => 2500, 'position' => '15%'],
                        ['name' => 'Lime Green Hoodie', 'description' => 'Branded Plain Hoodie - Fleece', 'price' => 2500, 'position' => '50%'],
                        ['name' => 'Maroon Hoodie', 'description' => 'Branded Plain Hoodie - Fleece', 'price' => 2500, 'position' => '85%'],
                    ] as $hoodie)
                        <article class="border border-zinc-200 bg-zinc-100">
                            <div class="h-80 border-b border-zinc-200 bg-white bg-contain bg-center bg-no-repeat" style="background-image: url('{{ asset('images/branding-hoodie-products.png') }}'); background-position: {{ $hoodie['position'] }} center; background-size: 310% auto;"></div>
                            <div class="p-6">
                                <h4 class="text-2xl font-light text-zinc-600">{{ $hoodie['name'] }}</h4>
                                <p class="mt-6 text-lg font-medium text-zinc-600">{{ $hoodie['description'] }}</p>
                                <div class="mt-7 flex items-center justify-between gap-4">
                                    <a href="#branding-order" class="rounded-md bg-rose-600 px-7 py-4 text-lg font-bold text-white transition hover:bg-rose-700">Add to cart</a>
                                    <p class="text-xl font-bold text-zinc-600">Shs&nbsp; {{ number_format($hoodie['price']) }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-7 grid gap-7 md:grid-cols-2 xl:grid-cols-4">
                    @foreach([
                        ['name' => 'Black Hoodie', 'description' => 'Branded Plain Hoodie - Fleece', 'price' => 2500, 'position' => '12%'],
                        ['name' => 'Orange Hoodie', 'description' => 'Branded Plain Hoodie - Fleece', 'price' => 2500, 'position' => '38%'],
                        ['name' => 'Yellow Hoodie', 'description' => 'Branded Plain Hoodie - Fleece', 'price' => 2500, 'position' => '64%'],
                        ['name' => 'White Hoodie', 'description' => 'Branded Plain Hoodie - Fleece', 'price' => 2500, 'position' => '88%'],
                    ] as $hoodie)
                        <article class="border border-zinc-200 bg-zinc-100">
                            <div class="h-80 border-b border-zinc-200 bg-white bg-contain bg-center bg-no-repeat" style="background-image: url('{{ asset('images/branding-hoodie-products-2.png') }}'); background-position: {{ $hoodie['position'] }} center; background-size: 390% auto;"></div>
                            <div class="p-6">
                                <h4 class="text-2xl font-light text-zinc-600">{{ $hoodie['name'] }}</h4>
                                <p class="mt-6 text-lg font-medium text-zinc-600">{{ $hoodie['description'] }}</p>
                                <div class="mt-7 flex items-center justify-between gap-4">
                                    <a href="#branding-order" class="rounded-md bg-rose-600 px-7 py-4 text-lg font-bold text-white transition hover:bg-rose-700">Add to cart</a>
                                    <p class="text-xl font-bold text-zinc-600">Shs&nbsp; {{ number_format($hoodie['price']) }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="mt-12">
                @if($homepageContent->services_eyebrow || $homepageContent->services_title)
                    <div class="mb-6">
                        @if($homepageContent->services_eyebrow)
                            <p class="text-sm font-bold uppercase tracking-[0.2em] text-emerald-700">{{ $homepageContent->services_eyebrow }}</p>
                        @endif
                        @if($homepageContent->services_title)
                            <h3 class="mt-2 text-3xl font-black">{{ $homepageContent->services_title }}</h3>
                        @endif
                    </div>
                @endif
                <div class="grid gap-4 md:grid-cols-3">
                @foreach($services as $service)
                    <article class="border border-zinc-200 p-5">
                        <p class="text-sm font-bold uppercase tracking-wide text-zinc-500">{{ $service->icon }}</p>
                        <h3 class="mt-3 text-xl font-black">{{ $service->name }}</h3>
                        <p class="mt-3 text-sm leading-6 text-zinc-600">{{ $service->description }}</p>
                        @if($service->starting_price)<p class="mt-4 font-bold">From KSh {{ number_format($service->starting_price) }}</p>@endif
                    </article>
                @endforeach
                </div>
            </div>
        </div>

        <form id="branding-order" method="POST" action="{{ route('inquiries.store') }}" class="mx-auto mt-12 grid max-w-7xl gap-3 px-4 sm:px-6 md:grid-cols-2">
            @csrf
            <input name="name" placeholder="Your name" class="field" required>
            <input name="email" type="email" placeholder="Email address" class="field" required>
            <input name="phone" placeholder="Phone number" class="field">
            <input name="company" placeholder="Business / company" class="field">
            <select name="branding_service_id" class="field md:col-span-2"><option value="">Select service</option>@foreach($services as $service)<option value="{{ $service->id }}">{{ $service->name }}</option>@endforeach</select>
            <textarea name="message" rows="5" placeholder="Tell us what you need branded" class="field md:col-span-2" required></textarea>
            <button class="rounded-md bg-amber-400 px-5 py-3 font-bold text-zinc-950 md:col-span-2">{{ $homepageContent->inquiry_button_label ?: 'Send branding inquiry' }}</button>
        </form>
    </section>
</main>

<footer class="border-t border-white/10 px-4 py-8 text-center text-sm text-zinc-400">{{ $homepageContent->footer_text ?: 'Addeh Prince and Thayu Nation. Built for music, tickets, and Kenyan brand growth.' }}</footer>
@endsection
