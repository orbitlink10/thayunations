@extends('layouts.admin')
@section('content')
<h1 class="text-3xl font-black">{{ $service->exists ? 'Edit service' : 'New service' }}</h1>
<form method="POST" action="{{ $service->exists ? route('admin.services.update',$service) : route('admin.services.store') }}" class="form-panel">
    @csrf @if($service->exists) @method('PUT') @endif
    @include('admin.shared.errors')
    <input class="field" name="name" placeholder="Service name" value="{{ old('name',$service->name) }}" required>
    <input class="field" name="icon" placeholder="Icon label, e.g. palette" value="{{ old('icon',$service->icon ?? 'sparkles') }}" required>
    <input class="field" name="starting_price" type="number" step="0.01" placeholder="Starting price" value="{{ old('starting_price',$service->starting_price) }}">
    <textarea class="field" name="description" rows="5" placeholder="Description" required>{{ old('description',$service->description) }}</textarea>
    <label class="check"><input type="checkbox" name="is_published" value="1" @checked(old('is_published',$service->is_published ?? true))> Published</label>
    <button class="btn">{{ $service->exists ? 'Save service' : 'Create service' }}</button>
</form>
@endsection
