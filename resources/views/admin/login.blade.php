@extends('layouts.admin')
@section('content')
<div class="mx-auto max-w-md rounded-lg bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-black">Admin login</h1>
    <p class="mt-2 text-sm text-zinc-500">Manage music, events, tickets, and Thayu Nation services.</p>
    @if($errors->any())<div class="mt-4 rounded-md bg-red-100 px-4 py-3 text-sm text-red-900">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('admin.login.store') }}" class="mt-6 grid gap-4">
        @csrf
        <input class="field" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
        <input class="field" name="password" type="password" placeholder="Password" required>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="remember" value="1"> Remember me</label>
        <button class="rounded-md bg-zinc-950 px-5 py-3 font-bold text-white">Login</button>
    </form>
</div>
@endsection
