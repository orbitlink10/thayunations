@extends('layouts.admin')
@section('content')
<div class="toolbar"><div><h1 class="text-3xl font-black">Events</h1><p class="text-zinc-500">Create shows and sell tickets.</p></div><a class="btn" href="{{ route('admin.events.create') }}">New event</a></div>
<div class="panel mt-6">@foreach($events as $event)<div class="row"><div><strong>{{ $event->title }}</strong><p>{{ $event->event_date->format('M d, Y g:i A') }} - KSh {{ number_format($event->ticket_price) }}</p></div><div class="actions"><a href="{{ route('admin.events.edit',$event) }}">Edit</a><form method="POST" action="{{ route('admin.events.destroy',$event) }}">@csrf @method('DELETE')<button>Delete</button></form></div></div>@endforeach{{ $events->links() }}</div>
@endsection
