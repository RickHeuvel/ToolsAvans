<?php

use Illuminate\Database\Seeder;

class ToolStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_status')->insert([
            'status' => 'active'
        ]);
    }
}
