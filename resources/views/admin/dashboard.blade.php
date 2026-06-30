@extends('layouts.admin')
@section('content')
<div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div><h1 class="text-3xl font-black">Dashboard</h1><p class="mt-1 text-zinc-500">Monitor content, ticket reservations, and branding inquiries.</p></div>
</div>
<div class="mt-6 grid gap-4 sm:grid-cols-3">
    <div class="stat"><span>Songs</span><strong>{{ $songCount }}</strong></div>
    <div class="stat"><span>Events</span><strong>{{ $eventCount }}</strong></div>
    <div class="stat"><span>Services</span><strong>{{ $serviceCount }}</strong></div>
</div>
<div class="mt-8 grid gap-6 xl:grid-cols-2">
    <section class="panel"><h2 class="panel-title">Recent ticket orders</h2>@forelse($ticketOrders as $order)<div class="row"><div><strong>{{ $order->customer_name }}</strong><p>{{ $order->event->title }} - {{ $order->quantity }} ticket(s)</p></div><span>KSh {{ number_format($order->total_amount) }}</span></div>@empty<p class="empty">No ticket orders yet.</p>@endforelse</section>
    <section class="panel"><h2 class="panel-title">Branding inquiries</h2>@forelse($inquiries as $inquiry)<div class="row"><div><strong>{{ $inquiry->name }}</strong><p>{{ $inquiry->brandingService->name ?? 'General inquiry' }} - {{ $inquiry->phone }}</p></div><span>{{ $inquiry->created_at->diffForHumans() }}</span></div>@empty<p class="empty">No inquiries yet.</p>@endforelse</section>
</div>
@endsection
