<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

    }
}
