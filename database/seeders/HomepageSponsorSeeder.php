<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomepageSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cols = DB::connection('legacy')->table("wp_artsthread_sponsors")->get();

        foreach ($cols as $col){

            Sponsor::create([
                'id' => $col->id,
                'name' => $col->name,
                'url' => $col->url,
                'image_small' => $col->image_small,
                'image_medium' => $col->image_medium,
                'image_large' => $col->image_large,
                'sort_order' => $col->sort_order,
                'display' => $col->displayed,
            ]);

        }

    }
}
