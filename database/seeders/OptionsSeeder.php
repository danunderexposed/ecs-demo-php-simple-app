<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::create([
            'option_name' => 'artsthread_homepage_grid',
            'option_value' => '[\"675\",\"745\",\"759\",\"170\",\"723\",\"751\",\"764\",\"763\",\"762\",\"756\",\"744\",\"766\",\"765\",\"668\",\"740\"]'
        ]);

        Option::create([
            'option_name' => 'artsthread_homepage_feat_sector1',
            'option_value' => '[]'
        ]);

        Option::create([
            'option_name' => 'artsthread_homepage_feat_sector2',
            'option_value' => '[]'
        ]);

        Option::create([
            'option_name' => 'artsthread_featured_profiles',
            'option_value' => '[]'
        ]);
    }
}
