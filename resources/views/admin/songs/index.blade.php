@extends('layouts.admin')
@section('content')
<div class="toolbar"><div><h1 class="text-3xl font-black">Songs</h1><p class="text-zinc-500">Upload releases, artwork, and streaming links.</p></div><a class="btn" href="{{ route('admin.songs.create') }}">New song</a></div>
<div class="panel mt-6">@foreach($songs as $song)<div class="row"><div><strong>{{ $song->title }}</strong><p>{{ optional($song->release_date)->format('M d, Y') ?? 'No date' }} @if($song->is_featured) - Featured @endif</p></div><div class="actions"><a href="{{ route('admin.songs.edit',$song) }}">Edit</a><form method="POST" action="{{ route('admin.songs.destroy',$song) }}">@csrf @method('DELETE')<button>Delete</button></form></div></div>@endforeach{{ $songs->links() }}</div>
@endsection
