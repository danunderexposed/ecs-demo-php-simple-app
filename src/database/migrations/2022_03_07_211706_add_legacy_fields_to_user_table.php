<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLegacyFieldsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('slug')->nullable();
            $table->string('displayname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('surname')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->string('tel')->nullable();
            $table->string('school')->nullable();
            $table->string('division')->nullable();
            $table->unsignedBigInteger('course')->nullable();
            //$table->foreign('course')->references('id')->on('courses');
            $table->string('coursetitle')->nullable();
            $table->string('studylevel')->nullable();
            $table->string('sector')->nullable();
            $table->string('sector2')->nullable();
            $table->string('sector3')->nullable();
            $table->string('specialism')->nullable();
            $table->string('specialism2')->nullable();
            $table->string('specialism3')->nullable();
            $table->string('competitions')->nullable();
            $table->string('ip')->nullable();
            $table->date('registerdate')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('utype')->nullable();
            $table->text('profile')->nullable();
            $table->string('profile_name')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('profile_image_small')->nullable();
            $table->string('website')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('vimeo_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('googleplus_url')->nullable();
            $table->string('pinterest_url')->nullable();
            $table->unsignedBigInteger('olduserid')->nullable();
            $table->string('oldcompetitions')->nullable();
            $table->string('oldurl')->nullable();
            $table->boolean('subscribed')->default(false);
            $table->date('projects_last_updated')->nullable();
            $table->string('userType')->nullable();
            $table->string('companyname')->nullable();
            $table->string('companyposition')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('gradyear')->nullable();
            $table->string('nationality')->nullable();
            $table->boolean('messagesend')->default(true);
            $table->boolean('messagesendallow')->default(true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'slug', 'displayname', 'firstname', 'surname', 'address1', 'address2', 'city', 'postcode', 'country', 'tel', 'school', 'division', 'course', 'coursetitle', 'studylevel', 'sector', 'sector2', 'sector3', 'specialism', 'specialism2', 'specialism3', 'competitions', 'ip','registerdate', 'verified', 'utype', 'profile', 'profile_name', 'profile_image', 'profile_image_small', 'website', 'twitter_id', 'twitter_url', 'linkedin_id', 'linkedin_url', 'vimeo_url', 'instagram_url', 'googleplus_url', 'pinterest_url', 'olduserid', 'oldcompetitions', 'oldurl', 'subscribed', 'projects_last_updated', 'userType', 'companyname', 'companyposition', 'gender', 'dob', 'gradyear', 'nationality', 'messagesend', 'messagesendallow' ]);
        });
    }
}
