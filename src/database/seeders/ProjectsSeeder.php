<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $no_of_rows = 90000;
        $range=range( 1, $no_of_rows );
        $chunksize=10000;

        foreach( array_chunk( $range, $chunksize ) as $chunk ){

            $projects = DB::connection('legacy')->table("wp_artsthread_projects")->whereBetween('id', [$chunk[0], end($chunk)])->get();

            foreach ($projects as $p){

                $data = [
                    'id' => $p->id,
                    'user_id' => $p->userid,
                    'slug' => $p->slug,
                    'title' => $p->title,
                    'description' => $p->description,
                    'cover_small' => $p->cover_small,
                    'cover_medium' => $p->cover_medium,
                    'cover_large' => $p->cover_large,
                    'display' => $p->display,
                    'type' => $p->type,
                    'specialism' => $p->specialism,
                    'specialism2' => $p->specialism2,
                    'specialism3' => $p->specialism3,
                    'sort_order' => $p->sort_order,
                    'oldgalleryid' => $p->oldgalleryid,
                    'views' => $p->views,
                    'likes' => $p->likes,
                    'comments' => $p->comments > 0 ? $p->comments : 0,
                    'ytag_link' => $p->ytag_link
                ];

                Project::updateOrCreate(['id' => $p->id], $data);
            }
        }
        Schema::enableForeignKeyConstraints();

    }
}
