<?php

use Illuminate\Database\Seeder;

class ToolSpecificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_specifications')->insert([
            'tool_slug' => 'heroku',
            'specification' => 'interne tool',
            'value' => 'Ja',
        ]);

        DB::table('tool_specifications')->insert([
            'tool_slug' => 'heroku',
            'specification' => 'Download grootte',
            'value' => '5MB',
        ]);
    }
}