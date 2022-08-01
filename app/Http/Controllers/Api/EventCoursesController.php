<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EventCoursesController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id');

        if (!$id){
            return response()->json([]);
        }

        $sql = "SELECT
                courses.id as course_id,
                courses.name as course_name,
                schools.school as school_name,
                courses.image_medium as image_medium
                FROM events_entry
                JOIN users
                ON events_entry.userid = users.id
                JOIN courses
                ON users.course = courses.id
                JOIN schools
                ON courses.school = schools.id
                WHERE eventid = :id
                AND events_entry.active = 1
                GROUP BY courses.id
                ORDER BY course_name ASC";

        $results = DB::select( DB::raw($sql), array('id' => $id,));

        $response = array_map(
            function( $results ) {
                // Create the final array of the details we need.
                return array(
                    'id' => $results->course_id,
                    'name' => $results->course_name,
                    'school' => $results->school_name,
                    'image' => $results->image_medium
                );
            },
            $results
          );

        return response()->json($response);
    }
}
