<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.events.index', ['events' => Event::latest('event_date')->paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.form', ['event' => new Event()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Event::create($this->payload($request));
        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.events.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.events.form', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->update($this->payload($request, $event));
        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event deleted.');
    }

    private function payload(Request $request, ?Event $event = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'venue' => ['required', 'string', 'max:160'],
            'city' => ['required', 'string', 'max:80'],
            'ticket_price' => ['required', 'numeric', 'min:0'],
            'tickets_available' => ['required', 'integer', 'min:0'],
            'poster_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['slug'] = $event?->exists ? $event->slug : Str::slug($data['title']).'-'.Str::random(5);
        $data['is_published'] = $request->boolean('is_published', true);
        if ($request->hasFile('poster_image')) {
            $data['poster_image'] = $request->file('poster_image')->store('events', 'public');
        }

        return $data;
    }
}
