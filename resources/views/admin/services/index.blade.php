@extends('layouts.admin')
@section('content')
<div class="toolbar"><div><h1 class="text-3xl font-black">Branding Services</h1><p class="text-zinc-500">Promote Thayu Nation offers.</p></div><a class="btn" href="{{ route('admin.services.create') }}">New service</a></div>
<div class="panel mt-6">@foreach($services as $service)<div class="row"><div><strong>{{ $service->name }}</strong><p>{{ $service->icon }} - From KSh {{ number_format($service->starting_price) }}</p></div><div class="actions"><a href="{{ route('admin.services.edit',$service) }}">Edit</a><form method="POST" action="{{ route('admin.services.destroy',$service) }}">@csrf @method('DELETE')<button>Delete</button></form></div></div>@endforeach{{ $services->links() }}</div>
@endsection
