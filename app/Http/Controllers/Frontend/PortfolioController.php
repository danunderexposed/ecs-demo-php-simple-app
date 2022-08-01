<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Traits\UserAttributes;
use Carbon\Carbon;

class PortfolioController extends Controller
{
    use UserAttributes;

    public function index(Request $request)
    {
        return view('frontend.portfolio.index');
    }

    public function show(Request $request, string $slug)
    {
        $portfolio = Project::where('slug', $slug)->with(['media', 'specialismOne', 'specialismTwo', 'specialismThree','competitions','events'])->first();
        if(!$portfolio) {
            return redirect('/');
        }
        if(is_null($portfolio->user->coursetitle)) {
            $portfolio->user->coursetitle = $this->getCourseTitle($portfolio->user);
        }
        $portfolio->user->schoolimage = $this->getSchoolImage($portfolio->user);
        $portfolio->user->schoolname = $this->getSchoolName($portfolio->user);
        
        return view('frontend.portfolio.show', [
            'portfolio' => $portfolio
        ]);
    }

}
