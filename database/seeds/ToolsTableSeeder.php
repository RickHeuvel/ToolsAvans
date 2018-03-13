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
        DB::table('tools')->insert([
            'name' => 'Heroku',
            'slug' => 'heroku',
            'uploader_id' => '1',
            'category_slug' => 'webservice',
            'status' => 'actief',
            'description' => 'Nice description! A lot of useful info!',
            'logo_filename' => 'heroku-thumbnail.png',
            'url' => 'https://heroku.com/',
            'slug' => 'heroku'
        ]);
        DB::table('tools')->insert([
            'name' => 'Webdictaat',
            'uploader_id' => '1',
            'category_slug' => 'website',
            'status' => 'actief',
            'description' => 'Nice description! A lot of useful info!',
            'logo_filename' => 'heroku-thumbnail.png',
            'url' => 'https://webdictaat.com/',
            'slug' => 'webdictaat'
        ]);
        DB::table('tools')->insert([
            'name' => 'Kahoot!',
            'uploader_id' => '1',
            'category_slug' => 'website',
            'status' => 'actief',
            'description' => 'Nice description! A lot of useful info!',
            'logo_filename' => 'heroku-thumbnail.png',
            'url' => 'https://kahoot.com/',
            'slug' => 'kahoot'
        ]);
        mkdir('storage/app/tool-images');
        copy('http://www.wizarddevelopment.com/assets/heroku-logo-3fd853cc0508639b85b41af0cdc97b8f.png', 'storage/app/tool-images/heroku-thumbnail.png');
    }
}
