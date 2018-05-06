<?php

use Illuminate\Database\Seeder;

class ToolTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_tags')->insert([
            'tool_slug' => 'heroku',
            'tag_slug' => 'betaald',
        ]);

        DB::table('tool_tags')->insert([
            'tool_slug' => 'visualstudio',
            'tag_slug' => 'microsoft',
        ]);

        DB::table('tool_tags')->insert([
            'tool_slug' => 'visualstudio',
            'tag_slug' => 'programmeren',
        ]);

        DB::table('tool_tags')->insert([
            'tool_slug' => 'discord',
            'tag_slug' => 'gratis',
        ]);

        DB::table('tool_tags')->insert([
            'tool_slug' => 'kahoot',
            'tag_slug' => 'gratis',
        ]);

        DB::table('tool_tags')->insert([
            'tool_slug' => 'kahoot',
            'tag_slug' => 'quiz',
        ]);
    }
}
