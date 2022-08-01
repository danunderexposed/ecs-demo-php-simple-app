<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{

    public function index(Request $request)
    {
        return view('frontend.event.index');
    }

    public function show(Request $request, string $slug)
    {
        $event = Event::where('slug', $slug)->where('active', 1)->where('is_hidden', '!=', 1)->first();
        if(!$event) {
            return redirect('/');
        }
        $sidebarEvents = Event::where('active', 1)->where('is_hidden', '!=', 1)->whereDate('end_date', '>', Carbon::now())->get()->random(1);
        return view('frontend.event.show', [
            'event' => $event,
            'sidebarEvents' => $sidebarEvents
        ]);
    }

}
