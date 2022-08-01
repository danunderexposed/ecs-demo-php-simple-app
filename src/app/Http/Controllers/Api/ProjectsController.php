<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $app_post_id = $request->input('app_post_id');
        $where = [];
        // Prepase statement that can be used for either event or school
        $sql = "SELECT  projects.id,
                      projects.title,
                      projects.slug,
                      projects.cover_large,
                      users.firstname,
                      users.surname,
                      users.country,
                      users.city,
                      projects.specialism,
                      projects.specialism2,
                      projects.specialism3
                      FROM projects as projects";


        if ($event_id = $request->input('event_id')) {
            // It's an event we are getting the listings for.
            // First off get the list of projects related to the event.
            $sql .=  " LEFT OUTER JOIN events_entry as event_entries
            ON projects.id = event_entries.projectid
            LEFT OUTER JOIN users as users
            ON event_entries.user_id = users.id
            WHERE event_entries.active = 1
            AND event_entries.eventid = :event_id ";
            $where['event_id'] = $event_id;
        }

        // Here I would do a similar thing for school.
        if ($school_id = $request->input('school_id')) {
            $sql .=  " LEFT OUTER JOIN users as users
            ON projects.user_id = users.id
            LEFT OUTER JOIN schools as schools
            ON users.school = schools.id";
            $sql .= " WHERE users.school = :school_id
            AND projects.sort_order = 1";
            $where['school_id'] = $school_id;
        }

        // If competition_id.
        if ($competition_id = $request->input('competition_id')) {
            // Link in the competition stuff.
            $sql .= " LEFT OUTER JOIN competitions_entry as competition_entries
            ON projects.id = competition_entries.projectid
            LEFT OUTER JOIN users as users
            ON competition_entries.user_id = users.id
            WHERE competition_entries.compid = :competition_id
            AND competition_entries.voting = 1";
            $where['competition_id'] = $competition_id;
        }

        // Graduation year if set.
        $graduation_year = $request->input('graduation_year');
        if( $graduation_year && is_numeric($graduation_year)) {
            $sql .= " AND users.gradyear = :graduation_year";
            $where['graduation_year'] = $graduation_year;
        }

        // Course ID add the And clause to the where statement.
        if ($course_id = $request->input('course_id')) {
            $sql .= " AND users.course = :course_id";
            $where['course_id'] = $course_id;
        }

        // We can also do the filtering by specialism here.
        if ($specialisms = $request->input('specialisms')) {

            if ($competition_id) {
                // If it's a competition only get the projects with the first specialism being the match. As it's vote by specialism.
                $sql .=  " AND projects.specialism IN ($specialisms)";
            } else {
                $sql .=  " AND (projects.specialism IN ($specialisms) OR projects.specialism2 IN ($specialisms) OR projects.specialism3 IN ($specialisms))";
            }
        }

        // Do we have a student name to search for?
        if ($student_name = $request->input('name')) {
            $sql .= "  AND (users.firstname LIKE '%%".$student_name."%%' OR users.surname LIKE '%%".$student_name."%%' OR CONCAT(TRIM(users.firstname), ' ', TRIM(users.surname)) LIKE '%%".$student_name."%%')";
        }

        // Do we have school in the filter?
        if($schools = $request->input('schools')) {
            $sql .= " AND ( users.school IN (SELECT id FROM schools WHERE id IN ($schools)))";
        }

        // There are override filters set for the app and we haven't filtered by a specialism.
        if($override_filters = $request->input('override_filters') && !isset($specialisms)) {
            $sql .=  " AND projects.specialism IN ($override_filters)";
        }

        // First get the count of total posts with no limit
        $count = DB::select( DB::raw($sql), $where);

        $count = sizeof($count);

        // Order by random with with the seed.
        if($seed = $request->input('seed')) {
            $sql .= " ORDER BY RAND(" . $seed . ")";
        }

        $ppp = $request->input('ppp');
        if($page = $request->input('page')) {
            $offset = $ppp * $page;
        } else {
            $offset = 0;
        }

        // Add the paging and limit
        $sql .= " LIMIT " . $offset . ", " . $ppp;


        $projects = DB::select( DB::raw($sql), $where);

        // Get the project data.
        $project_results = array_map(array($this, 'getProjectData'), $projects);

        // Set a default winners of false.
        $winners = false;

        // Now we also need to add a winners array it's a competition and there are any set.
        if ($competition_id) {
          $sql = "SELECT  projects.id,
                      projects.title,
                      projects.slug,
                      projects.cover_large,
                      users.firstname,
                      users.surname,
                      users.country,
                      users.city,
                      projects.specialism,
                      projects.specialism2,
                      projects.specialism3
                      FROM projects as projects
              LEFT OUTER JOIN competitions_entry as competition_entries
              ON projects.id = competition_entries.projectid
              LEFT OUTER JOIN users as users
              ON competition_entries.user_id = users.id
              WHERE competition_entries.compid = :competition_id
              AND competition_entries.voting = 1
              AND competition_entries.winner = 1";

          // There are override filters set for the app and we haven't filtered by a specialism. So we need to filter the winners by this too.
          if($override_filters && !isset($specialisms)) {
            $sql .=  " AND projects.specialism IN ($override_filters)";
          }

          $sql .= " ORDER BY RAND()";
          $winners = DB::select( DB::raw($sql), ['competition_id' => $competition_id]);
          $winners = array_map(array($this, 'getProjectData'), $winners);
      }

      $response = [
        'count' => $count,
        'projects' => $project_results,
        'winners' => $winners
      ];
      return response()->json($response);
    }

    private function getProjectData( $project ) {


        // In here we need to do a wp_query for their specialisms based on the ids for them we got in the project object.
        $specialisms_sql =
        "SELECT specialism
        FROM specialisms
        WHERE id IN($project->specialism, $project->specialism2, $project->specialism3)
        ORDER BY FIELD(id,$project->specialism, $project->specialism2, $project->specialism3)";
        // ORDER BY the order of project specialisms given in the where in clause 1, 2, 3.

        $specialisms = DB::select( DB::raw($specialisms_sql));

        $specialism_text = "";
        $count = 1;
        foreach($specialisms as $specialism) {

            $specialism_text .= $specialism->specialism;
            if(count($specialisms) > 0 && $count != count($specialisms)) {
            $specialism_text  .= ', ';
            } else {
            $specialism_text  .= '.';
            }
            $count++;
        }

        // In here we get their country/city location based on the ids for them we git in the project object
        $location_sql = "SELECT countries.name AS country_name, cities.name AS city_name
        FROM countries as countries
        LEFT OUTER JOIN cities as cities
        ON countries.id = cities.country_id
        WHERE countries.id = :country
        AND cities.id = :city
        LIMIT 1";

        $locations = DB::select( DB::raw($location_sql),
            [
                'country' => $project->country,
                'city' => $project->city,
            ]
        );

        $location_text = $locations[0]->city_name .', ' . $locations[0]->country_name;

        // Create the final array of the details we need.
        return array(
            'id' => $project->id,
            'slug' => $project->slug,
            'title' => ucwords(strtolower($project->title)),
            'image' => $project->cover_large,
            'surname' => $project->surname,
            'firstname' => $project->firstname,
            'specialisms' => $specialism_text,
            'location'=> $location_text,
        );
    }
}
