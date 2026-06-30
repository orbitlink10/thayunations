<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandingService;
use App\Models\Event;
use App\Models\Inquiry;
use App\Models\Song;
use App\Models\TicketOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'songCount' => Song::count(),
            'eventCount' => Event::count(),
            'serviceCount' => BrandingService::count(),
            'ticketOrders' => TicketOrder::with('event')->latest()->take(8)->get(),
            'inquiries' => Inquiry::with('brandingService')->latest()->take(8)->get(),
        ]);
    }
}
