<?php

namespace Database\Seeders;

use App\Models\Homepage;
use App\Utilities\WordpressAPI;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomepageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(WordpressAPI $wpApi)
    {
        $cols = DB::connection('legacy')->table("wp_artsthread_homepage")->get();
        //$wpApi = new WordpressAPI();

        foreach ($cols as $col){

            // get images
            $image = null;
            if (is_numeric($col->image) && $col->image != 0){
                $image = $wpApi->media($col->image);
                $image = $image->media_details->sizes->full->source_url;
            } else {
                $image = $col->image;
            }

            $mobile_image = null;
            if (is_numeric($col->mobile_image)  && $col->mobile_image != 0){
                $mobile_image = $wpApi->media($col->mobile_image);
                $mobile_image = $mobile_image->media_details->sizes->full->source_url;
            } else {
                $mobile_image = $col->mobile_image;
            }

            Homepage::create([
                'id' => $col->id,
                'name' => $col->name,
                'type' => $col->type,
                'image' => $image,
                'link' => $col->link,
                'headtxt' => $col->headtxt,
                'headclr' => $col->headclr,
                'headbg' => $col->headbg,
                'copytxt' => $col->copytxt,
                'copyclr' => $col->copyclr,
                'copybg' => $col->copybg,
                'modulebg' => $col->modulebg,
                'videoid' => $col->videoid,
                'videotype' => $col->videotype,
                'mobile_image' => $mobile_image
            ]);

        }

    }
}
