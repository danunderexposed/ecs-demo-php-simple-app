<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $pages = DB::connection('legacy')->table("wp_posts")->where('post_type', 'page')->where('post_content', '<>', '')->get();

        foreach ($pages as $p){
            $data = [
                'id' => $p->ID,
                'title' => $p->post_title,
                'content' => $p->post_content,
                'status' => $p->post_status,
                'slug' => $p->post_name,
                'link' => $p->guid,
                'parent_page_id' => $p->post_parent,
            ];

            Page::updateOrCreate(['id' => $p->ID], $data);
        }

        Schema::enableForeignKeyConstraints();

    }
}
