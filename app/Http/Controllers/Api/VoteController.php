<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VoteController extends Controller
{
    public function index(Request $request)
    {
        if(!$project_id = $request->input('project_id')
            && !$competition_id = $request->input('competition_id')){
            return response()->json([]);
        }

        $project_id = $request->input('project_id');
        $competition_id = $request->input('competition_id');
        $specialism_id = $request->input('specialism_id');

        // Now we get the current totalvotes count for the project
        $sql = "SELECT totalvotes FROM competitions_entry WHERE projectid = :project_id AND compid = :competition_id LIMIT 1";

        $result = DB::select( DB::raw($sql),
            [
                'project_id' => $project_id,
                'competition_id' => $competition_id,
            ]
        );

        // Else we have a record so we bump up the current votes by one and update the record.
        $currentvotes = $result[0]->totalvotes;
        $newvotes = $result[0]->totalvotes + 1;

        $sql = "UPDATE competitions_entry
        SET totalvotes = :newvotes, specialism_id = :specialism_id
        WHERE compid = :competition_id
        AND  projectid = :project_id";

        DB::update( DB::raw($sql),
            [
                'newvotes' => $newvotes,
                'specialism_id' => $specialism_id,
                'competition_id' => $competition_id,
                'project_id' => $project_id,
            ]
        );

    }
}
