<?php

use Illuminate\Database\Seeder;

class ToolViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\ToolView', 98)->states('taiga')->create();
        factory('App\ToolView', 1001)->states('slack')->create();
        factory('App\ToolView', 13)->states('github')->create();
    }
}
