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
        DB::table('tool_category')->insert([
            'category' => 'webservice'
        ]);

        DB::table('tool_status')->insert([
            'status' => 'active'
        ]);

        DB::table('users')->insert([
            'name' => 'testuser',
            'email' => '1',
            'provider' => 'avans',
            'provider_id' => 'testuser',
            'nickname' => 'besttester',
            'firstName' => 'test',
            'lastName' => 'user',
            'location' => 'avans hogeschool',
            'role' => 'admin'
        ]);

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
