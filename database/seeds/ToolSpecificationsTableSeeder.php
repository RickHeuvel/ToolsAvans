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
            'slug' => 'interne-tool',
            'name' => 'interne tool',
            'value' => 'Ja',
        ]);

        DB::table('tool_specifications')->insert([
            'tool_slug' => 'github',
            'slug' => 'interne-tool',
            'name' => 'interne tool',
            'value' => 'Ja',
        ]);

        DB::table('tool_specifications')->insert([
            'tool_slug' => 'heroku',
            'slug' => 'download-grootte',
            'name' => 'Download grootte',
            'value' => '5MB',
        ]);
    }
}
