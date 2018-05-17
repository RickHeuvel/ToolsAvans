<?php

use Illuminate\Database\Seeder;

class TagCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tag_category')->insert([
            'slug' => 'programmeertaal',
            'name' => 'Programmeertaal',
        ]);

        DB::table('tag_category')->insert([
            'slug' => 'verdienmodel',
            'name' => 'Verdienmodel',
        ]);

        DB::table('tag_category')->insert([
            'slug' => 'soortservice',
            'name' => 'Soort service',
        ]);
    }
}
