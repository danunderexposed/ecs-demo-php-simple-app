<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Utilities\ConvertUrlsFromString;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $slug = $request->input('slug');
        $project_result = [];

        if($request->input('competition_id')) {
            $competition_id = $request->input('competition_id');
            $sql = "SELECT id FROM projects WHERE slug = '" . $this->slug . "' LIMIT 1";
            $project = DB::select( DB::raw($sql), ['slug' => $slug,]);;
            $sql = "SELECT * FROM competitions_entry WHERE compid = :compid AND projectid = :projectid AND voting = 1 limit 1";
            $comp_entry= DB::select( DB::raw($sql), ['compid' => $competition_id, 'projectid' => $project[0]->id]);;

            if(sizeof($comp_entry) === 0) {
                return response()->json([]);
            }
        }

        // Prepase statement that can be used for either event or school
        $sql = "SELECT  projects.id AS id,
                        projects.title,
                        projects.cover_large,
                        projects.description,
                        projects.slug,
                        users.id as userid,
                        users.firstname,
                        users.surname,
                        users.country,
                        users.city,
                        users.school,
                        users.course,
                        users.twitter_url,
                        users.linkedin_url,
                        users.pinterest_url,
                        users.instagram_url,
                        users.slug as user_slug,
                        projects.specialism,
                        projects.specialism2,
                        projects.specialism3
                FROM projects as projects
                LEFT OUTER JOIN users as users
                ON projects.user_id = users.id
                WHERE projects.slug = :slug
                LIMIT 1";

        $project= DB::select( DB::raw($sql), array('slug' => $slug,));

        $project_result = array_map(
            function( $project ) {
                // In here we need to do a wp_query for their specialisms based on the ids for them we got in the project object.
                $specialisms_sql = "SELECT specialism FROM specialisms
                WHERE id IN($project->specialism, $project->specialism2, $project->specialism3)
                ORDER BY FIELD(id,$project->specialism, $project->specialism2, $project->specialism3)";

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

                // In here we get their country/city location based on the ids for them we got in the project object
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
                        'city' => $project->city
                    ]
                );

                $location_text = $locations[0]->city_name .', ' . $locations[0]->country_name;

                // In here we get their school/university location based on the ids for them we got in the project object
                $school_sql = "SELECT schools.school
                FROM schools as schools
                WHERE schools.id = :school
                LIMIT 1";

                $schools = DB::select( DB::raw($school_sql), ['school' => $project->school]);
                $school = $schools[0]->school;

                // In here we get their school/university location based on the ids for them we got in the project object
                $course_sql = "SELECT courses.name
                FROM courses as courses
                WHERE courses.id = :course
                LIMIT 1";

                $courses = DB::select( DB::raw($course_sql), ['course' => $project->course]);
                $course = $courses[0]->name;

                // Now get all the associated project images.
                $media_sql = "SELECT id,slug,title,description,image_small,image_medium,image_large
                FROM projects_media
                AS media
                WHERE project_id=:id
                AND type = 'image'
                ORDER BY sort_order ASC";

                $medias = DB::select( DB::raw($media_sql), ['id' => $project->id]);


                $images = array_map(
                    function( $media ) {
                        return array(
                            'image_small'=> $media->image_small,
                            'image_medium'=> $media->image_medium,
                            'image_large'=> $media->image_large
                        );
                    }
                    ,$medias
                );

                // Now get all the associated project videos.
                $media_sql = "SELECT image_medium,vidurl
                FROM projects_media
                AS media
                WHERE project_id=:id
                AND type = 'video'
                ORDER BY sort_order ASC";

                $medias = DB::select( DB::raw($media_sql), ['id' => $project->id]);


                $videos = array_map(
                    function( $media ) {
                        return array(
                            'image_medium'=> $media->image_medium,
                            'vidurl'=> $media->vidurl
                        );
                    }
                    ,$medias
                );


                // Create the final array of the details we need.
                return [
                    'id' => $project->id,
                    'slug' => $project->slug,
                    'profile_url' => 'https://artsthread.com/profile/' . $project->user_slug . '/',
                    'title' => ucwords(strtolower($project->title)),
                    'content' => nl2br(ConvertUrlsFromString::convert(htmlspecialchars(trim(strip_tags($project->description))))),
                    'image' => $project->cover_large,
                    'surname' => $project->surname,
                    'firstname' => $project->firstname,
                    'specialisms' => $specialism_text,
                    'main_specialism_id' => $project->specialism,
                    'location'=> $location_text,
                    'images'=> $images,
                    'videos'=> $videos,
                    'twitter_url' => $project->twitter_url,
                    'linkedin_url' => $project->linkedin_url,
                    'pinterest_url' => $project->pinterest_url,
                    'instagram_url' => $project->instagram_url,
                    'school' => $school,
                    'course' => $course,
                    'userid' => $project->userid
                ];
            },
            $project
        );

        return response()->json($project_result);
    }
}
