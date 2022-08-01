<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // truncate tables
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::connection('mysql')->table('schools')->truncate();
        // DB::connection('mysql')->table('cities')->truncate();
        // DB::connection('mysql')->table('countries')->truncate();
        // DB::connection('mysql')->table('homepage')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            CountriesSeeder::class,
            CitySeeder::class,
            SchoolSeeder::class,
            HomepageSeeder::class,
            OptionsSeeder::class,
            SectorsSeeder::class,
            CoursesSeeder::class,
            SpecialismsSeeder::class,
            StudyLevelsSeeder::class,
            ProjectsSeeder::class,
            ProjectMediaSeeder::class,
            EventsSeeder::class,
            RolesSeeder::class,
            UserSeeder::class,
            CompetitionSeeder::class,
            HomepageSponsorSeeder::class,
            AdvertsSeeder::class,
            BlogSeeder::class,
            CompetitionEntrySeeder::class,
            MessagesSeeder::class,
            PagesSeeder::class,
            SponsorSeeder::class,
            LikesSeeder::class,
        ]);

    }
}
