<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $messages = DB::connection('legacy')->table("wp_artsthread_messages")->get();

        foreach ($messages as $m){

            $data = [
                'id' => $m->id,
                'userid' => $m->userid,
                'useremail' => $m->useremail,
                'username' => $m->username,
                'messagerid' => $m->messagerid,
                'messageremail' => $m->messageremail,
                'messagername' => $m->messagername,
                'subject' => $m->subject,
                'category' => $m->category,
                'message' => $m->message,
                'ip' => $m->ip,
                'sentdate' => $m->sentdate
            ];

            Message::updateOrCreate(['id' => $m->id], $data);
        }

        Schema::enableForeignKeyConstraints();
    }
}
