<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'homepagecategory',
            'val' => 'website'
        ]);

        DB::table('settings')->insert([
            'name' => 'homepagetag',
            'val' => 'programmeren'
        ]);
    }
}
