<?php

use Illuminate\Database\Seeder;

class ToolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Tool::truncate();  

        DB::table('tools')->insert([
            'name' => 'Heroku',
            'uploader_id' => '1',
            'category' => 'webservice',
            'status' => 'active',
            'views' => '1',
            'description' => 'Nice description! A lot of useful info!'
        ]);
        
        //factory(App\Tool::class, 3)->create();
    }
}
