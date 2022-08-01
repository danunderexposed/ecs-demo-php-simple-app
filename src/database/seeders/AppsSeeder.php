<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // **** Manual seeding required for content modules and override filters ****

        // content modules e.g. 81336
        // override filters true example 83465
        // dmu = 82301

        $apps = DB::connection('legacy')->table("wp_posts")->where('post_type','at-apps')->where('ID', 82301)->get();


        foreach ($apps as $a){

            // get custom fields
            $appType = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'app_type')->pluck('meta_value')->first();
            $appId = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'app_id')->pluck('meta_value')->first();
            $show_course_index = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'show_course_index')->pluck('meta_value')->first();
            $allow_voting =  DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'allow_voting')->pluck('meta_value')->first();
            $allow_voting = $allow_voting == null ? false : true;
            $event_id = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'event_id')->pluck('meta_value')->first();
            $school_id = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'school_id')->pluck('meta_value')->first();
            $hide_projects = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'hide_projects')->pluck('meta_value')->first();
            $hide_projects = $hide_projects == null ? false : true;
            $competition_id = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'competition_id')->pluck('meta_value')->first();
            $index_title =  DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'index_title')->pluck('meta_value')->first();
            $index_text =  DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'index_text')->pluck('meta_value')->first();
            $listings_title =  DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'listings_title')->pluck('meta_value')->first();
            $listings_text =  DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'listings_text')->pluck('meta_value')->first();
            $graduation_year =  DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'graduation_year')->pluck('meta_value')->first();
            $padding_left = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'padding_left')->pluck('meta_value')->first();;
            $padding_right = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'padding_right')->pluck('meta_value')->first();
            $padding_top = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'padding_top')->pluck('meta_value')->first();
            $padding_bottom = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'padding_bottom')->pluck('meta_value')->first();
            $projects_per_page = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'projects_per_page')->pluck('meta_value')->first();
            $google_analytics = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'google_analytics_id')->pluck('meta_value')->first();
            $google_analytics_global = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'google_analytics_from_global')->pluck('meta_value')->first();
            $content_modules = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'content_modules')->pluck('meta_value')->first();
            //dd($content_modules);
            $filter_sectors_db = DB::connection('legacy')->table("wp_postmeta")->select('meta_value')->where('post_id', $a->ID)->where('meta_key', 'LIKE', 'filter_sectors_%')->get(); //->pluck('meta_value')->first();

            $filter_sectors = [];
            foreach ($filter_sectors_db as $s){
                $filter_sectors[] = $s->meta_value;
            }
          //  dd($filter_sectors);

            $override_filters = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'override_filters')->pluck('meta_value')->first();

            $filters_override = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'LIKE', 'filters_override_%')->select('meta_value')->get();
            //dd($filters_override);

      //      $school_filters = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'filter_sectors')->pluck('meta_value')->first();
            $capitalise_buttons = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'capitalise_buttons')->pluck('meta_value')->first();

            $courses_to_exclude = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'courses_to_exclude')->pluck('meta_value')->first();
            $enable_filter_by_year = DB::connection('legacy')->table("wp_postmeta")->where('post_id', $a->ID)->where('meta_key', 'enable_filter_by_year')->pluck('meta_value')->first();
            $enable_filter_by_year = $enable_filter_by_year == null ? false : true;


            $data = [
                'id' => $a->ID,
                'title' => $a->post_title,
                'app_id' => $appId,
                'app_type' => $appType,
                'school_id' => $school_id,
                'courses_exclude' => $courses_to_exclude,
                'hide_projects' => $hide_projects,
                'show_course_index' => $show_course_index,
                'graduation_year' => $graduation_year,
                'enable_year_filter' => $enable_filter_by_year,
                'projects_per_page' => $projects_per_page,
                'override_filters' => $override_filters,
                'filter_sectors' => $filter_sectors,
                //'content_modules' => $content_modules,
                'index_title' => $index_title,
                'index_text' => $index_text,
                'listings_title' => $listings_title,
                'listings_text' => $listings_text,
                'capitalise_buttons' => $capitalise_buttons,
                'padding_left' => $padding_left,
                'padding_right' => $padding_right,
                'padding_top' => $padding_top,
                'padding_bottom' => $padding_bottom,
                'google_analytics' => $google_analytics,
                'google_analytics_global' => $google_analytics_global,
                'event_id' => $event_id,
                'competition_id' => $competition_id,
                'allow_voting' => $allow_voting,
           //     'school_filters' => $school_filters,
                //'filters_override' => $override_filters,
            ];

         //  dd($data);

            App::updateOrCreate(['id' => $a->ID], $data);
        }
    }
}
