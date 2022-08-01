<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = DB::connection('legacy')->table("wp_artsthread_countries")->get();

        foreach ($countries as $country){
            Country::create(['id' => $country->id, 'name' => $country->country]);
        }
    }
}
