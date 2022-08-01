<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sponsors = DB::connection('legacy')->table("wp_artsthread_sponsors")->where('displayed', 1)->get();

        foreach ($sponsors as $s){

            Sponsor::updateOrCreate([
                'id' => $s->id,
                'name' => $s->name,
                'url' => $s->url,
                'image_small' => $s->image_small,
                'image_medium' => $s->image_medium,
                'image_large' => $s->image_large,
                'sort_order' => $s->sort_order,
                'display' => $s->displayed
            ]);
        }

    }
}
