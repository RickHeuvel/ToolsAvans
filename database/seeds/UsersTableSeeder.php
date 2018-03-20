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
            'name' => 'beheerder',
            'email' => 'admin@toolhub.com',
            'provider' => 'avans',
            'provider_id' => 'beheerder',
            'nickname' => 'Beheerder',
            'firstName' => 'beheerder',
            'lastName' => '',
            'location' => 'OWB',
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'magweter',
            'email' => 'mag.vandewetering@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'magweter',
            'nickname' => 'Martijn van de Wetering',
            'firstName' => 'Martijn',
            'lastName' => 'van de Wetering',
            'location' => 'OWB',
            'role' => 'admin'
        ]);
    }
}
