<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompetitionEntry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CompetitionEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $comps = DB::connection('legacy')->table("wp_artsthread_competitions_entry")->get();

        foreach ($comps as $c) {

            $data = [
                'id' => $c->id,
                'compid' => $c->compid,
                'userid' => $c->userid,
                'entered' => $c->entered == "0000-00-00 00:00:00" ? null : $c->entered,
                'projectid' => $c->projectid,
                'category' => $c->category,
                'winner' => $c->winner,
                'shortlist' => $c->shortlist,
                'runnerup' => $c->runnerup,
                'popular' => $c->popular,
                'voting' => $c->voting,
                'totalvotes' => $c->totalvotes,
                'specialism_id' => $c->specialism_id,
            ];

            CompetitionEntry::updateOrCreate(["id" => $c->id], $data);
        }

        Schema::enableForeignKeyConstraints();
    }
}
