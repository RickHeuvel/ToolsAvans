<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'tool_slug' => 'heroku',
            'user_id' => '1',
            'title' => 'Goede webhosting, makkelijk in gebruik',
            'rating' => '4',
            'description' => 'Heroku werkt goed samen met travis, ik beveel het erg aan medestudenten.',
            'created_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'tool_slug' => 'github',
            'user_id' => '1',
            'title' => 'Beter dan bitbucket',
            'rating' => '5',
            'description' => 'Github is voor mij essentieel voor het werken in projecten.',
            'created_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'tool_slug' => 'google-drive',
            'user_id' => '1',
            'title' => 'Samen documenten maken',
            'rating' => '5',
            'description' => 'Samen documenten maken is de beste feature van Googol Drive.',
            'created_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'tool_slug' => 'slack',
            'user_id' => '1',
            'title' => 'Kan beter',
            'rating' => '3',
            'description' => 'Slack heeft veel potentieel, ze mogen wel wat veranderen aan het hoge RAM gebruik van hun desktop applicatie',
            'created_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'tool_slug' => 'kahoot',
            'user_id' => '1',
            'title' => 'Leuke, andere manier voor een quiz',
            'rating' => '5',
            'description' => 'Weg met de quiz, kahoot! is hier die een interactieve manier geeft om te leren.',
            'created_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'tool_slug' => 'gcolor2',
            'user_id' => '1',
            'title' => 'Doet wat het moet doen',
            'rating' => '5',
            'description' => 'Ik gebruik het dagelijks, erg aanbevolen!',
            'created_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'tool_slug' => 'galculator',
            'user_id' => '1',
            'title' => 'Een rekenmachine',
            'rating' => '5',
            'description' => 'Voor Linux gebruikers kan je dit niet missen op je systeem.',
            'created_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'tool_slug' => 'photoshop',
            'user_id' => '1',
            'title' => 'Erg duur',
            'rating' => '2',
            'description' => 'Het programma werkt goed, ik kan het mij alleen niet veroorloven.',
            'created_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'tool_slug' => 'visualstudio',
            'user_id' => '1',
            'title' => 'Makkelijke software om software te maken',
            'rating' => '4',
            'description' => 'Crasht alleen vaak dus als ze dit oplossen wel 5 sterren',
            'created_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'tool_slug' => 'onthehub',
            'user_id' => '1',
            'title' => 'Wie wil geen gratis software',
            'rating' => '5',
            'description' => 'Onmisbare software als student.',
            'created_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'tool_slug' => 'taiga',
            'user_id' => '1',
            'title' => 'Scrumboard slecht vindbaar',
            'rating' => '1',
            'description' => 'Kan bijna niks vinden op deze website, het scrumtaskboard zit onnodig ver weggestopt.',
            'created_at' => now(),
        ]);
    }
}
