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
            'category' => 'webservice'
        ]);
    }
}
