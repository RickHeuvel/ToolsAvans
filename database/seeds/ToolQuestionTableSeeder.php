<?php

use Illuminate\Database\Seeder;

class ToolQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_questions')->insert([
            'id' => '1',
            'tool_slug' => 'heroku',
            'user_id' => '1',
            'title' => 'Hoe werkt dit?',
            'text' => 'Ik heb al meer dan 5 youtube filmpjes gekeken maar snap er nog niks van',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '2',
            'tool_slug' => 'heroku',
            'user_id' => '2',
            'title' => 'Hoe werkt dit?',
            'text' => 'Ik heb al meer dan 5 youtube filmpjes gekeken maar snap er nog niks van',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '3',
            'tool_slug' => 'heroku',
            'user_id' => '4',
            'title' => 'Hoe werkt dit?',
            'text' => 'Ik heb al meer dan 5 youtube filmpjes gekeken maar snap er nog niks van',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '4',
            'tool_slug' => 'google-drive',
            'user_id' => '2',
            'title' => 'Is het gratis?',
            'text' => 'titel',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '5',
            'tool_slug' => 'google-drive',
            'user_id' => '5',
            'title' => 'Is het gratis?',
            'text' => 'titel',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '6',
            'tool_slug' => 'discord',
            'user_id' => '3',
            'title' => 'Hoe kan ik servers joinen?',
            'text' => 'Ik snap niet hoe je servers kan joinen, je hebt iets van een invite link nodig maar ik snap het niet',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '7',
            'tool_slug' => 'discord',
            'user_id' => '9',
            'title' => 'Hoe kan ik servers joinen?',
            'text' => 'Ik snap niet hoe je servers kan joinen, je hebt iets van een invite link nodig maar ik snap het niet',
            'created_at' => now(),
        ]);


        DB::table('tool_questions')->insert([
            'id' => '8',
            'tool_slug' => 'mysql-workbench',
            'user_id' => '4',
            'title' => 'Hoe reverse engineer ik een database model?',
            'text' => 'Als ik op reverse engineer klikt dan krijg ik een error "connection refused"',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '9',
            'tool_slug' => 'github',
            'user_id' => '5',
            'title' => 'Hoe maak ik mijn repository private?',
            'text' => 'Ik heb al meer dan 400 pull requests en 200 issues gekregen van spam bots HELP MIJ?',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '10',
            'tool_slug' => 'github',
            'user_id' => '1',
            'title' => 'Hoe maak ik mijn repository private?',
            'text' => 'Ik heb al meer dan 400 pull requests en 200 issues gekregen van spam bots HELP MIJ?',
            'created_at' => now(),
        ]);


        DB::table('tool_questions')->insert([
            'id' => '11',
            'tool_slug' => 'github',
            'user_id' => '12',
            'title' => 'Hoe maak ik mijn repository private?',
            'text' => 'Ik heb al meer dan 400 pull requests en 200 issues gekregen van spam bots HELP MIJ?',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '12',
            'tool_slug' => 'github',
            'user_id' => '13',
            'title' => 'Hoe maak ik mijn repository private?',
            'text' => 'Ik heb al meer dan 400 pull requests en 200 issues gekregen van spam bots HELP MIJ?',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '13',
            'tool_slug' => 'github',
            'user_id' => '9',
            'title' => 'Hoe maak ik mijn repository private?',
            'text' => 'Ik heb al meer dan 400 pull requests en 200 issues gekregen van spam bots HELP MIJ?',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '14',
            'tool_slug' => 'kahoot',
            'user_id' => '6',
            'title' => 'Wat moet ik doen als ik kleuren blind ben?',
            'text' => 'Is er een soort van colorblind mode ofzo?',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '15',
            'tool_slug' => 'onthehub',
            'user_id' => '7',
            'title' => 'Ik heb geen avans account',
            'text' => 'Waar kan ik een avans account aanmaken? ik snap het niet',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '16',
            'tool_slug' => 'onthehub',
            'user_id' => '1',
            'title' => 'Ik heb geen avans account',
            'text' => 'Waar kan ik een avans account aanmaken? ik snap het niet',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '17',
            'tool_slug' => 'photoshop',
            'user_id' => '8',
            'title' => 'Niet voor linux',
            'text' => 'Wat moet ik doen als ik dit programma op linux moet gebruiken?',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '18',
            'tool_slug' => 'slack',
            'user_id' => '9',
            'title' => 'PAGE FAULT IN NON PAGED AREA',
            'text' => 'Ik krijg deze error en dan een bluescreen op windows? Ik heb genoeg memory, mijn pc is 2000 euro met 2GB RAM DDR2',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '19',
            'tool_slug' => 'taiga',
            'user_id' => '10',
            'title' => 'Kanban',
            'text' => 'Wat is kanban, ik heb overal gezocht maar kan het niet vinden.',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '20',
            'tool_slug' => 'taiga',
            'user_id' => '2',
            'title' => 'Kanban',
            'text' => 'Wat is kanban, ik heb overal gezocht maar kan het niet vinden.',
            'created_at' => now(),
        ]);

        DB::table('tool_questions')->insert([
            'id' => '21',
            'tool_slug' => 'visualstudio',
            'user_id' => '11',
            'title' => 'Visual studio debugg',
            'text' => 'Visual studio crasht heel vaak, kan ik visual studio debuggen met visualstudio voor visualstudioception',
            'created_at' => now(),
        ]);


        DB::table('tool_questions')->insert([
            'id' => '22',
            'tool_slug' => 'heroku',
            'user_id' => '3',
            'title' => 'Hoe werkt dit?',
            'text' => 'Ik heb al meer dan 5 youtube filmpjes gekeken maar snap er nog niks van',
            'created_at' => now(),
        ]);
    }
}
