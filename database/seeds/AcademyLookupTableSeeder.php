<?php

use Illuminate\Database\Seeder;

class AcademyLookupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academy_lookup')->insert([
            'slug' => 'aii',
            'name' => 'AII'
        ]);
    }
}
