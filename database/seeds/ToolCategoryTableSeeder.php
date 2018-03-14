<?php

use Illuminate\Database\Seeder;

class ToolCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_category')->insert([
            'name' => 'Webservice',
            'slug' => 'webservice'
        ]);

        DB::table('tool_category')->insert([
            'name' => 'Website',
            'slug' => 'website'
        ]);

        DB::table('tool_category')->insert([
            'name' => 'Download',
            'slug' => 'download'
        ]);
    }
}
