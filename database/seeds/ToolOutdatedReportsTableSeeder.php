<?php

use Illuminate\Database\Seeder;

class ToolOutdatedReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_outdated_reports')->insert([
            'tool_slug'  => 'visualstudio',
            'user_id'    => 10,
            'feedback'   => 'Visual Studio word helemaal niet meer gebruikt.Visual Studio word helemaal niet meer gebruikt.Visual Studio word helemaal niet meer gebruikt.Visual Studio word helemaal niet meer gebruikt.Visual Studio word helemaal niet meer gebruikt.',
            'created_at' => now(),
        ]);
    }
}
