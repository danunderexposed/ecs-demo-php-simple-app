<?php

namespace Database\Seeders;

use App\Models\StudyLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = DB::connection('legacy')->table("wp_artsthread_studylevels")->get();

        foreach ($levels as $s){
            StudyLevel::create([
                'id' => $s->id,
                'studylevel' => $s->studylevel
            ]);
        }
    }
}
