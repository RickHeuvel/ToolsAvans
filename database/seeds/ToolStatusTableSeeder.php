<?php

use Illuminate\Database\Seeder;

class ToolStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_status')->insert([
            'slug' => 'actief',
            'name' => 'Actief'
        ]);
        DB::table('tool_status')->insert([
            'slug' => 'inactief',
            'name' => 'Inactief'
        ]);
        DB::table('tool_status')->insert([
            'slug' => 'concept',
            'name' => 'Concept'
        ]);
        DB::table('tool_status')->insert([
            'slug' => 'afgekeurd',
            'name' => 'Afgekeurd'
        ]);
        DB::table('tool_status')->insert([
            'slug' => 'verouderd',
            'name' => 'Verouderd'
        ]);
    }
}
