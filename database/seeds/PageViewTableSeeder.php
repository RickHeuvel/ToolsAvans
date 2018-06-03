<?php

use Illuminate\Database\Seeder;

class PageViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\PageView', 500)->create([
            'name' => 'home'
        ]);
        factory('App\PageView', 350)->create([
            'name' => 'tools'
        ]);
        factory('App\PageView', 100)->create([
            'name' => 'portal'
        ]);
        factory('App\PageView', 30)->create([
            'name' => 'contact'
        ]);
    }
}
