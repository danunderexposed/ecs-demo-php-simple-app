<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use Carbon\Carbon;

class SchoolController extends Controller
{

    public function index(Request $request)
    {
        return view('frontend.school.index');
    }

    public function show(Request $request, string $slug)
    {
        $school = School::where('slug', $slug)->first();
        if(!$school) {
            return redirect('/');
        }
        return view('frontend.school.show', [
            'school' => $school
        ]);
    }

}
