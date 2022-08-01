<?php

namespace Database\Seeders;

use App\Models\Likes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $likes = DB::connection('legacy')->table("wp_artsthread_likes")->where('projectid', '>', 77605)->get();

        Schema::disableForeignKeyConstraints();

        foreach ($likes as $l){
            $data = [
                'id' => $l->id,
                'userid' => !empty($l->userid) ? $l->userid : null,
                'projectid' => $l->projectid,
                'ip' => !empty($l->ip) ? $l->ip : null,
                'dateupdated' => $l->dateupdated,
            ];

            Likes::updateOrCreate(['id' => $l->id], $data);
        }

        Schema::enableForeignKeyConstraints();
    }
}
