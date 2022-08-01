<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = DB::connection('legacy')->table("wp_artsthread_cities")->get();

        foreach ($cities as $c){
            if (Country::find($c->countryid)){
                City::create(['id' => $c->id, 'name' => $c->city, 'country_id' => $c->countryid]);
            }
        }
    }
}
