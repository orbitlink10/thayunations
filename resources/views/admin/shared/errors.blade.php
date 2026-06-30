@if($errors->any())
    <div class="rounded-md bg-red-100 px-4 py-3 text-sm text-red-900">
        {{ $errors->first() }}
    </div>
@endif
