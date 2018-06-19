<?php

use Illuminate\Database\Seeder;

class ToolAcademyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_academy')->insert([
            'academy_slug' => 'aii',
            'tool_slug' => 'heroku'
        ]);
    }
}
