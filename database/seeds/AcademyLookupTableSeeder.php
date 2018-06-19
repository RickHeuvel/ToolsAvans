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
        
        DB::table('academy_lookup')->insert([
            'slug' => 'aaad',
            'name' => 'AAAd'
        ]);
        
        DB::table('academy_lookup')->insert([
            'slug' => 'afm',
            'name' => 'AFM'
        ]);
		
		DB::table('academy_lookup')->insert([
            'slug' => 'ahb',
            'name' => 'AHB'
        ]);
		
		DB::table('academy_lookup')->insert([
            'slug' => 'amib',
            'name' => 'AMIB'
        ]);
		
		DB::table('academy_lookup')->insert([
            'slug' => 'aomi',
            'name' => 'AOMI'
        ]);
		
		DB::table('academy_lookup')->insert([
            'slug' => 'avb',
            'name' => 'AVB'
        ]);

		DB::table('academy_lookup')->insert([
            'slug' => 'avd',
            'name' => 'AVD'
        ]);

		DB::table('academy_lookup')->insert([
            'slug' => 'atgm',
            'name' => 'ATGM'
        ]);

		DB::table('academy_lookup')->insert([
            'slug' => 'agz',
            'name' => 'AGZ'
        ]);
		
		DB::table('academy_lookup')->insert([
            'slug' => 'asb',
            'name' => 'ASB'
        ]);

		DB::table('academy_lookup')->insert([
            'slug' => 'ash',
            'name' => 'ASH'
        ]);

		DB::table('academy_lookup')->insert([
            'slug' => 'akv',
            'name' => 'AKV'
        ]);
    }
}
