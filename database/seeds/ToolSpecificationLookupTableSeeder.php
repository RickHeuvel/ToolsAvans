<?php

use Illuminate\Database\Seeder;

class ToolSpecificationLookupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_specification_lookup')->insert([
            'slug' => 'interne-tool',
            'name' => 'Interne tool',
            'default' => '1',
        ]);

        DB::table('tool_specification_lookup')->insert([
            'slug' => 'fabrikant',
            'name' => 'Fabrikant',
            'default' => '0',
        ]);

        DB::table('tool_specification_lookup')->insert([
            'slug' => 'download-grootte',
            'name' => 'Download grootte',
            'category' => 'download',
            'default' => '0',
        ]);
        

    }
}
