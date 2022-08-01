<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schools = DB::connection('legacy')->table("wp_artsthread_schools")->get();

        foreach ($schools as $s){
            // find city
            $city = DB::connection('legacy')->table("wp_artsthread_cities")->find($s->cityid);
            $cityId = $city->id;
            $countryId = $city->countryid;

            $data = [
                'id' => $s->id,
                'slug' => $s->slug,
                'country_id' => $countryId,
                'city_id' => $cityId,
                'school' => $s->school,
                'image' => $s->image,
                'image_medium' => $s->image_medium,
                'image_small' => $s->image_small,
                'slider' => $s->slider,
                'slider_medium' => $s->slider_medium,
                'slider_small' => $s->slider_small,
                'excerpt' => $s->excerpt,
                'description' => $s->description,
                'website' => $s->website,
                'twitter' => $s->twitter,
                'facebook' => $s->facebook,
                'linkedin' => $s->linkedin,
                'youtube' => $s->youtube,
                'instagram' => $s->instagram,
                'vimeo' => $s->vimeo,
                'pinterest' => $s->pinterest,
                'featured' => $s->featured,
                'separate' => $s->separate,
                'display_instagram' => $s->display_instagram,
                'instagram_user' => $s->instagram_user,
                'instagram_title' => $s->instagram_title,
                'displaytype' => $s->displaytype,
                'profiles' => $s->profiles,
                'projects' => $s->projects,
                'courses' => $s->courses,
                'schoolorder' => $s->schoolorder
            ];

            School::create($data);
        }
    }
}
