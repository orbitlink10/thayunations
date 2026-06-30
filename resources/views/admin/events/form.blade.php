@extends('layouts.admin')
@section('content')
<h1 class="text-3xl font-black">{{ $event->exists ? 'Edit event' : 'New event' }}</h1>
<form method="POST" enctype="multipart/form-data" action="{{ $event->exists ? route('admin.events.update',$event) : route('admin.events.store') }}" class="form-panel">
    @csrf @if($event->exists) @method('PUT') @endif
    @include('admin.shared.errors')
    <input class="field" name="title" placeholder="Event title" value="{{ old('title',$event->title) }}" required>
    <textarea class="field" name="description" rows="4" placeholder="Description">{{ old('description',$event->description) }}</textarea>
    <input class="field" name="event_date" type="datetime-local" value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d\TH:i') : '') }}" required>
    <input class="field" name="venue" placeholder="Venue" value="{{ old('venue',$event->venue) }}" required>
    <input class="field" name="city" placeholder="City" value="{{ old('city',$event->city ?? 'Nairobi') }}" required>
    <input class="field" name="ticket_price" type="number" step="0.01" placeholder="Ticket price" value="{{ old('ticket_price',$event->ticket_price ?? 0) }}" required>
    <input class="field" name="tickets_available" type="number" placeholder="Tickets available" value="{{ old('tickets_available',$event->tickets_available ?? 0) }}" required>
    <input class="field" name="poster_image" type="file" accept="image/*">
    <label class="check"><input type="checkbox" name="is_published" value="1" @checked(old('is_published',$event->is_published ?? true))> Published</label>
    <button class="btn">{{ $event->exists ? 'Save event' : 'Create event' }}</button>
</form>
@endsection
