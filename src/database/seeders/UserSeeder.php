<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $no_of_rows = 95000;
        $range=range( 1, $no_of_rows );
        $chunksize=10000;

        foreach( array_chunk( $range, $chunksize ) as $chunk ){


            $cols = DB::connection('legacy')->table("wp_artsthread_users")->whereBetween('id', [$chunk[0], end($chunk)])->get();

            foreach ($cols as $c){

                // temp skip users with no email
                if (!$c->email) continue;

                // check for dupe email
                if (User::where('email', $c->email)->first()) continue;

                $data = [
                    'id' => $c->id,
                    'name' => $c->username,
                    'email' => $c->email,
                    'legacy_password' => $c->password,
                    'legacy_salt' => $c->salt,
                    'password' => 'legacy',
                    'slug' => $c->slug,
                    'displayname' => $c->displayname,
                    'firstname' => $c->firstname,
                    'surname' => $c->surname,
                    'address1' => $c->address1,
                    'address2' => $c->address2,
                    'city' => $c->city,
                    'postcode' => $c->postcode,
                    'country' => $c->country,
                    'tel' => $c->tel,
                    'school' => $c->school,
                    'division' => $c->division,
                    'course' => $c->course,
                    'coursetitle' => $c->coursetitle,
                    'studylevel' => $c->studylevel,
                    'sector' => $c->sector,
                    'sector2' => $c->sector2,
                    'sector3' => $c->sector3,
                    'specialism' => $c->specialism,
                    'specialism2' => $c->specialism2,
                    'specialism3' => $c->specialism3,
                    'competitions' => $c->competitions,
                    'ip' => $c->ip,
                    'registerdate' => $c->registerdate,
                    'verified' => $c->verified,
                    'utype' => $c->utype,
                    'profile' => preg_replace("/\r\n/","",$c->profile),
                    'profile_name' => $c->profile_name,
                    'profile_image' => $c->profile_image,
                    'profile_image_small' => $c->profile_image_small,
                    'website' => $c->website,
                    'twitter_id' => $c->twitter_id,
                    'twitter_url' => $c->twitter_url,
                    'linkedin_id' => $c->linkedin_id,
                    'linkedin_url' => $c->linkedin_url,
                    'vimeo_url' => $c->vimeo_url,
                    'instagram_url' => $c->instagram_url,
                    'googleplus_url' => $c->googleplus_url,
                    'pinterest_url' => $c->pinterest_url,
                    // 'olduserid' => $c->olduserid,
                    // 'oldcompetitions' => $c->oldcompetitions,
                    // 'oldurl' => $c->oldurl,
                    'subscribed' => $c->subscribed,
                    'projects_last_updated' => $c->projects_last_updated == '0000-00-00 00:00:00' ? null : $c->projects_last_updated,
                    'userType' => $c->userType,
                    'companyname' => $c->companyname,
                    'companyposition' => $c->companyposition,
                    'gender' => $c->gender,
                    'dob' => $c->dob == '0000-00-00' ? null : $c->dob,
                    'gradyear' => $c->gradyear,
                    'nationality' => $c->nationality,
                    'messagesend' => $c->messagesend,
                    'messagesendallow' => $c->messagesendallow
                ];

                User::updateOrCreate(["id" => $c->id], $data);
            }
        }
    }
}
