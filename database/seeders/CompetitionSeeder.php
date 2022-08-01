<?php

namespace Database\Seeders;

use App\Models\Competition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CompetitionCategory;
use App\Models\CompetitionCatAssign;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //CompetitionCategory::updateOrCreate(['id'=> 1, 'name' => 'Fashion']);

        $comps = DB::connection('legacy')->table("wp_artsthread_competitions")->get();

        foreach ($comps as $c) {

            $data = [
                'id' => $c->id,
                'slug' => $c->slug,
                'name' => $c->name,
                'link' => $c->link,
                'description' => $c->description,
                'image' => $c->image,
                'image_medium' => $c->image_medium,
                'image_small' => $c->image_small,
                'start_date' => $c->startdate,
                'end_date' => $c->enddate,
                'active' => $c->active,
                'entrydisplay' => $c->entrydisplay,
                'entrydisplayvote' => $c->entrydisplayvote,
                'entrytitle' => $c->entrytitle,
                'featured' => $c->featured,
                'displayads' => $c->displayads,
                'displaycomps' => $c->displaycomps,
                'displayfilters' => $c->displayfilters,
                'winnerdisplay' => $c->winnerdisplay,
                'winnertitle' => $c->winnertitle,
                'hidedetails' => $c->hidedetails,
                'preview' => $c->preview,
                'preview_description' => $c->preview_description,
                'preview_displayentry' => $c->preview_displayentry,
                'preview_displaycomps' => $c->preview_displaycomps,
                'preview_displayads' => $c->preview_displayads,
                'preview_displaywinners' => $c->preview_displaywinners,
                'preview_hidedetails' => $c->preview_hidedetails,
                'onlyportfolio' => $c->onlyportfolio,
                'status' => $c->status,
                'deadline' => $c->deadline,
                'votestart' => $c->votestart == '0000-00-00 00:00:00' ? null : $c->votestart,
                'voteend' => $c->voteend == '0000-00-00 00:00:00' ? null : $c->voteend,
                'voteoverride' => $c->voteoverride == 'disabled' ? false : true,
                'winnerdate' => $c->winnerdate == '0000-00-00 00:00:00' ? null : $c->winnerdate,
                'headexcerpt' => $c->headexcerpt,
                'profiledisplay' => $c->profiledisplay == 'display' ? true : false,
                'comporder' => $c->comporder,
                'created_at' => $c->created
            ];

            Competition::updateOrCreate($data);

        }

        CompetitionCatAssign::updateOrCreate(['compid' => 1, 'catid' => 1]);
        CompetitionCatAssign::updateOrCreate(['compid' => 37, 'catid' => 1]);

    }
}
