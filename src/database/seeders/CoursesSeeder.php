<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\StudyLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = DB::connection('legacy')->table("wp_artsthread_courses")->get();
        Schema::disableForeignKeyConstraints();
        foreach ($courses as $c){

            $sector1 = ($c->sector == 3 || $c->sector == 5) ? 1 : $c->sector;
            $sector2 = ($c->sector2 == 3 || $c->sector2 == 5) ? 1 : $c->sector2;
            $sector3 = ($c->sector3 == 3 || $c->sector3 == 5) ? 1 : $c->sector3;


            Course::create([
                'id' => $c->id,
                'email' => $c->email,
                'name' => $c->name,
                'slug' => $c->slug,
                'about' => $c->about,
                'studylevel_id' => $c->studylevel,
                'division' => $c->division,
                'address1' => $c->address1,
                'address2' => $c->address2,
                'postcode' => $c->postcode,
                'leadertitle' => $c->leadertitle,
                'leadername' => $c->leadername,
                'contactemail' => $c->contactemail,
                'contacturl' => $c->contacturl,
                'admissionemail' => $c->admissionemail,
                'admissionurl' => $c->admissionurl,
                'tel' => $c->tel,
                'school_id' => $c->school,
                'sector' => $sector1,
                'sector2' => $sector2,
                'sector3' => $sector3,
                'specialism' => $c->specialism ? $c->specialism : null,
                'specialism2' => $c->specialism2 ? $c->specialism2 : null,
                'specialism3' => $c->specialism3 ? $c->specialism3 : null,
                'country_id' => $c->country,
                'city_id' => $c->city,
                'image' => $c->image,
                'image_small' => $c->image_small,
                'image_medium' => $c->image_medium,
                'website' => $c->website,
                'active' => $c->active,
                'profiledisplaytype' => $c->profiledisplaytype,
                'profiles' => $c->profiles,
                'instagram_display' => $c->instagram_display,
                'instagram_url' => $c->instagram_url,
                'instagram_username' => $c->instagram_username,
                'courseorder' => $c->courseorder,
                'coursenotify' => $c->coursenotify,
                'main_image_link' => $c->main_image_link,
                'logo_link' => $c->logo_link
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
