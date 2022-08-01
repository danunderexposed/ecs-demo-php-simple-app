<?php

namespace Database\Seeders;

use App\Models\Advert;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ads = DB::connection('legacy')->table("wp_artsthread_adverts")->get();

        foreach ($ads as $a){

            $data = [
                'id' => $a->id,
                'name' => $a->name,
                'link' => $a->link,
                'image_small' => $a->image_small,
                'image_medium' => $a->image_medium,
                'image_large' => $a->image_large,
                'start_date' => $a->startdate,
                'end_date' => $a->enddate,
                'impressions' => $a->impressions,
                'clicks' => $a->clicks,
                'type' => $a->type,
                'display' => $a->display,
                'adorder' => $a->adorder
            ];

            Advert::updateOrCreate(['id' => $a->id], $data);
        }
    }
}
