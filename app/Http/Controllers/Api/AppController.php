<?php

namespace App\Http\Controllers\Api;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Utilities\ConvertUrlsFromString;

class AppController extends Controller
{
    public function index(Request $request)
    {
        $appId = $request->input('app_id');

        $app = App::where('app_id', $appId)->first();

        if (!$app){
            return response()->json([]);
        }

        // content modules ***

        // filter sectors
        if (!$app->override_filters) {
            $filter_sectors = $this->getFilterSectors($app);

        } else {
            // ***
            $filter_sectors = $this->getOverrideFilters($app);
        }

        $response = [
            'app_type' => $app->app_type,
            'app_id' => $app->app_id,
            'app_post_id' => $app->id,
            'show_course_index' => $app->show_course_index,
            'event_id' => $app->event_id,
            'school_id' => $app->school_id,
            'competition_id' => $app->competition_id,
            'allow_voting' => $app->allow_voting,
            'index_title' => $app->index_title,
            'index_text' => $app->index_text,
            'listings_title' => $app->listings_title,
            'listings_text' => $app->listings_text,
            'graduation_year' => $app->graduation_year,
            'padding_left' => $app->padding_left,
            'padding_right' => $app->padding_right,
            'padding_top' => $app->padding_top,
            'padding_bottom' => $app->padding_bottom,
            'filter_sectors' => $filter_sectors,
            'projects_per_page' => $app->projects_per_page,
            'google_analytics_id' => $app->google_analytics_id,
            'google_analytics_from_global' => $app->google_analytics_from_global,
            'override_filters' => $app->override_filters,
            'capitalise_buttons' => $app->capitalise_buttons,
            'school_filters' => $app->school_filters ?? [],
            'content_modules' => $app->content_modules,
            'hide_projects' => $app->hide_projects
        ];
        return response()->json($response);
    }

    private function getFilterSectors(App $app)
    {
        $filter_sectors = [];
        $where = [];
        if($app->app_type === 'competition') {
            $sql = "SELECT projects.specialism
                FROM projects as projects";
        } else {
            $sql = "SELECT projects.specialism,
                projects.specialism2,
                projects.specialism3
                FROM projects as projects";
        }

        // If there is an event_id get all the projects for that event.
        if ( $app->event_id && $app->app_type === 'event') {
            // It's an event we are getting the listings for.
            // First off get the list of projects related to the event.
            $sql .=  " LEFT OUTER JOIN users as users
            ON projects.user_id = users.id
            LEFT OUTER JOIN events_entry as event_entries
            ON projects.id = event_entries.projectid
            WHERE event_entries.active = 1
            AND event_entries.eventid = :event_id";
            $where['event_id'] = $app->event_id;
        }

        // Need to add a version for if there is an school ID insted
        if ( $app->school_id && $app->app_type === 'school') {
            $sql .=  " LEFT OUTER JOIN users as users
            ON projects.user_id = users.id
            LEFT OUTER JOIN schools as schools
            ON users.school = schools.id
            WHERE schools.id = :school_id
            AND projects.sort_order = 1";
            $where['school_id'] = $app->school_id;
        }

        // Need to add a version for if there is an competition ID insted
        if ( $app->competition_id && $app->app_type === 'competition') {
            $sql .= "
            LEFT OUTER JOIN users as users
            ON projects.user_id = users.id
            LEFT OUTER JOIN competitions_entry as competition_entries
            ON projects.id = competition_entries.projectid
            WHERE competition_entries.compid = :competition_id
            AND competition_entries.voting = 1";
            $where['competition_id'] = $app->competition_id;
        }

        if ( $app->graduation_year != '' ) {
            $sql .= " AND users.gradyear = :gradyear";
            $where['gradyear'] = $app->graduation_year;
        }

        // Looping through the project_specialisms that relate to this event/school and adding them to an array
        // Drop any values that are repeats.
        $project_specialisms_results = DB::select( DB::raw($sql), $where);

        $projects_specialisms = [];

        foreach($project_specialisms_results as $specialism) {

            if( !in_array($specialism->specialism, $projects_specialisms) && $specialism->specialism !== NULL ){
                $projects_specialisms[]=$specialism->specialism;
            }

            if( !in_array($specialism->specialism2, $projects_specialisms) && $specialism->specialism2 !== NULL){
                $projects_specialisms[]=$specialism->specialism2;
            }

            if( !in_array($specialism->specialism3, $projects_specialisms) && $specialism->specialism3 !== NULL){
                $projects_specialisms[]=$specialism->specialism3;
            }
        }

        // Now break out the project_specialisms that relate to the projects in the event/school into a string
        $projects_specialisms = implode(",", $projects_specialisms);


        $sectors = $app->filter_sectors;
        /* Now we have the sector id we can get an array of all the specialism ids that relate to that sector and pass it to the
        app as an array.
        */
        foreach ($sectors as $sector_id ) {

            $array = [];

            $sql = "SELECT sector FROM sectors WHERE id = :sector_id LIMIT 1";
            $sector = DB::select( DB::raw($sql), ['sector_id' => $sector_id]);

            $array['sector']['id'] = $sector_id;
            $array['sector']['name'] = $sector[0]->sector;

            // Get all the sectors that relate to the ID but that are in the projects_specialisms string. As they are the ones that relate to our event/school projects.
            $sql = "SELECT id, specialism FROM specialisms WHERE sector_id = :sector_id AND id IN ($projects_specialisms) ORDER BY specialism ASC";

            $specialisms = DB::select( DB::raw($sql), ['sector_id' => $sector_id]);

            $specialisms = array_map(
                function( $specialism ) {
                    return array(
                        'id' =>  $specialism->id,
                        'name' =>  $specialism->specialism
                    );
                },
                $specialisms
            );

            $array['specialisms'] = $specialisms;

            // So now we have the sector name
            array_push($filter_sectors, $array);
        }

        return $filter_sectors;
    }

    private function getOverrideFilters(App $app)
    {

        $filter_sectors = [];
        $filters_override = $app->filters_override;

        $override_filters = "";
        // $filters_override is a repeater field. So we need to loop through and fill out the array for
        // filter_sectors in the loop.
        foreach($filters_override as $override) {
            // We are overriding the filters here so no need for the sql query later.
            $array = array();
            $array['sector']['name'] = $override['sector_title'];
            $array['sector']['id'] = $override['sector_id'];

            $array['specialisms'] = array();

            // Now loop through the specialisms
            foreach($override['override_specialisms'] as $specialism) {

                $specialisms = array(
                    'id' =>  $specialism['specialism_id'],
                    'name' =>  $specialism['specialism_name']
                );

                $override_filters .= $specialisms['id'].',';
                array_push($array['specialisms'], $specialisms);
            }

            $override_filters = rtrim($override_filters, ',');

            // So now we have the sector name
            array_push($filter_sectors, $array);
        }

        return $filter_sectors;

    }

    private function getContentModules(App $app)
    {
        // return array of content modules

    }
}
