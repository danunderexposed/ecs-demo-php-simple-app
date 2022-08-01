<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $sectors = DB::connection('legacy')->table("wp_artsthread_sectors")->get();
        $sectors = [
            ['id' => 1, 'sector' => 'Fine Art/Photography/Craft'],
            ['id' => 2, 'sector' => 'Fashion/Textiles/Accessories'],
            ['id' => 4, 'sector' => 'Product / Architecture / Interiors'],
            ['id' => 6, 'sector' => 'Digital/Visual Communication/Film'],
        ];

        foreach ($sectors as $s){
            Sector::create([
                'id' => $s['id'],
                'sector' => $s['sector']
            ]);
        }
    }
}
