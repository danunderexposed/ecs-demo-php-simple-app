<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventEntry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $cols = DB::connection('legacy')->table("wp_artsthread_events")->get();

        foreach ($cols as $c){

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
                'featured' => $c->featured,
                'displayads' => $c->displayads,
                'displayevent' => $c->displayevent,
                'useradd' => $c->useradd,
                'approvalrequired'=> $c->approvalrequired,
                'is_hidden' => $c->is_hidden,
                'created_at' => $c->created
            ];

            Event::updateOrCreate(['id'=> $c->id], $data);

            $entries = DB::connection('legacy')->table("wp_artsthread_events_entry")->where('eventid', $c->id)->get();

            foreach ($entries as $e) {
                $data2 = [
                    'id' => $e->id,
                    'eventid' => $e->eventid,
                    'userid' => $e->userid,
                    'projectid' => $e->projectid,
                    'active' => $e->active,
                    'entered' => $e->entered
                ];

                EventEntry::updateOrCreate(['id'=> $e->id], $data2);
            }
        }
        Schema::enableForeignKeyConstraints();

    }
}
