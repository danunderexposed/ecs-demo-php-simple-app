<?php

namespace App\Http\Controllers\Api;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SchoolCoursesController extends Controller
{
    public function index(Request $request)
    {
        if(!$id = $request->input('id')) {
            return response()->json([]);
        }

        $app_post_id = $request->input('app_post_id');
        $app = App::find($app_post_id);
        if (!$app){
            return response()->json([]);
        }

        // Exclude courses?
        $courses_to_exclude = $app->courses_exclude;

        // Prepase statement that can be used for either event or school
        // Got make sure the course actually has projects in it!
        $sql = "SELECT
                courses.id as course_id,
                courses.name as course_name,
                schools.school as school_name,
                schools.id as school_id,
                courses.image_medium as image_medium
                FROM courses
                JOIN schools
                ON courses.school_id = schools.id
                WHERE schools.id = :id";

        if($courses_to_exclude != '' ) {
          $sql .= " AND courses.id NOT IN (" . $courses_to_exclude . ")";
        }

        $sql .= " GROUP BY courses.id ORDER BY course_name ASC";


        $courses = DB::select( DB::raw($sql), ['id' => $id]);

        foreach($courses as $key => $course_item) {
            $where = ['courseid' => $course_item->course_id];
            $sql = "SELECT projects.id as project_id
            FROM projects
            JOIN users
            ON projects.user_id = users.id
            WHERE users.course = :courseid";

            if($gradyear = $request->input('graduation_year')) {
                $sql .= " AND users.gradyear = :gradyear";
                $where['gradyear'] = $gradyear;
            }

            $projects = DB::select( DB::raw($sql), $where);

            if(sizeof($projects) ===  0) {
                // No projects for this course so remove them from the courses array
                unset($courses[$key]);
            }

        }

        // https://stackoverflow.com/questions/54355295/remove-empty-stdclass-object-from-array-in-php
        $courses = array_values($courses);


        $course_results = array_map(
            function( $course ) {
                // Create the final array of the details we need.
                return array(
                    'id' => $course->course_id,
                    'name' => $course->course_name,
                    'school' => $course->school_name,
                    'image' => $course->image_medium
                );
            },
            $courses
          );

        return response()->json($course_results);
    }
}
