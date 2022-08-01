<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{

    public function show(Request $request, string $slug)
    {
        $page = Page::where('slug', $slug)->where('status', 'publish')->first();
        if(!$page) {
            return redirect('/');
        }
        return view('frontend.page.show', [
            'page' => $page,
            //'sidebarEvents' => $sidebarEvents
        ]);
    }

    public function gdgs(Request $request)
    {
        return view('frontend.event.gdgs');
    }

}
