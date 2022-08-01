<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use Carbon\Carbon;

class CompetitionController extends Controller
{

    public function index(Request $request)
    {
        return view('frontend.competition.index');
    }

    public function show(Request $request, string $slug)
    {
        $competition = Competition::where('slug', $slug)->first();
        if(!$competition) {
            return redirect('/');
        }
        $sidebarCompetitions = Competition::where('active', 1)->where('onlyportfolio', 0)->whereDate('deadline', '>', Carbon::now())->get()->random(1);
        return view('frontend.competition.show', [
            'competition' => $competition,
            'sidebarCompetitions' => $sidebarCompetitions
        ]);
    }

}
