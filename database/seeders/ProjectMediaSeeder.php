<?php

namespace Database\Seeders;

use App\Models\ProjectMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProjectMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $no_of_rows = 770000;
        $range=range( 1, $no_of_rows );
        $chunksize=10000;

        foreach( array_chunk( $range, $chunksize ) as $chunk ){
            $media = DB::connection('legacy')->table("wp_artsthread_projectsmedia")->whereBetween('id', [$chunk[0], end($chunk)])->get();
            foreach ($media as $m){
                $data = [
                    'id' => $m->id,
                    'project_id' => $m->galleryid,
                    'slug' => $m->slug,
                    'description' => $m->description,
                    'type' => $m->type,
                    'display' => $m->display,
                    'sort_order' => $m->sort_order,
                    'image_small' => $m->image_small,
                    'image_medium' => $m->image_medium,
                    'image_large' => $m->image_large,
                    'vidurl' => $m->vidurl,
                    'is_video' => $m->vidurl ? true : false,
                    'oldmediaid' => $m->oldmediaid,
                ];

                ProjectMedia::updateOrCreate($data);

            }
        }

        Schema::enableForeignKeyConstraints();

    }
}
