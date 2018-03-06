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
            'slug' => 'heroku',
            'uploader_id' => '1',
            'category_id' => '1',
            'status' => 'active',
            'views' => '1',
            'description' => 'Nice description! A lot of useful info!',
            'thumbnail' => 'heroku-thumbnail.png',
            'url' => 'https://heroku.com/',
            'slug' => 'heroku'
        ]);
        DB::table('tools')->insert([
            'name' => 'Webdictaat',
            'uploader_id' => '1',
            'category_id' => '2',
            'status' => 'active',
            'views' => '1',
            'description' => 'Nice description! A lot of useful info!',
            'thumbnail' => 'heroku-thumbnail.png',
            'url' => 'https://webdictaat.com/',
            'slug' => 'webdictaat'
        ]);
        DB::table('tools')->insert([
            'name' => 'Kahoot!',
            'uploader_id' => '1',
            'category_id' => '2',
            'status' => 'active',
            'views' => '1',
            'description' => 'Nice description! A lot of useful info!',
            'thumbnail' => 'heroku-thumbnail.png',
            'url' => 'https://kahoot.com/',
            'slug' => 'kahoot'
        ]);
        copy('https://pbs.twimg.com/profile_images/700084762799550464/dbPz0Wiw_400x400.png', 'storage/app/heroku-thumbnail.png');
    }
}
