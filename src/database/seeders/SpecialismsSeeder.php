<?php

namespace Database\Seeders;

use App\Models\Specialism;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialismsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $specialisms = DB::connection('legacy')->table("wp_artsthread_specialisms")->get();

        foreach ($specialisms as $s){
            $sectorid = $s->sectorid;
            if ($sectorid == 3 || $sectorid == 5)
                $sectorid = 1;

            Specialism::create([
                'id' => $s->id,
                'sector_id' => $sectorid,
                'specialism' => $s->specialism,
                'slug' => $s->slug
            ]);
        }

    }
}
