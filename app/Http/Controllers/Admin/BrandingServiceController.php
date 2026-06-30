<?php

namespace App\Http\Controllers\Admin;

use App\Models\BrandingService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandingServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.services.index', ['services' => BrandingService::latest()->paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.form', ['service' => new BrandingService()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        BrandingService::create($this->payload($request));
        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.services.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BrandingService $service)
    {
        return view('admin.services.form', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BrandingService $service)
    {
        $service->update($this->payload($request, $service));
        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BrandingService $service)
    {
        $service->delete();
        return back()->with('success', 'Service deleted.');
    }

    private function payload(Request $request, ?BrandingService $service = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'description' => ['required', 'string'],
            'icon' => ['required', 'string', 'max:40'],
            'starting_price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $data['slug'] = $service?->exists ? $service->slug : Str::slug($data['name']).'-'.Str::random(5);
        $data['is_published'] = $request->boolean('is_published', true);

        return $data;
    }
}
