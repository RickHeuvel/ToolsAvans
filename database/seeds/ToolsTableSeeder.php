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
        //
        DB::table('tools')->insert([
            'name' => 'Heroku'
        ]);
        factory(App\Tool::class, 3)->create();
    }
}
