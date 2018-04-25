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
            'name' => 'pjmgootz',
            'email' => 'pjm.gootzen@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'pjmgootz',
            'nickname' => 'Peter-Jan Gootzen',
            'firstName' => 'Peter-Jan',
            'lastName' => 'Gootzen',
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
        DB::table('users')->insert([
            'name' => 'kmthulst',
            'email' => 'kmt.vanderhulst@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'kmthulst',
            'nickname' => 'Koen van der Hulst',
            'firstName' => 'Koen',
            'lastName' => 'van der Hulst',
            'location' => 'OWB',
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'rheuvel12',
            'email' => 'r.vandenheuvel12@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'rheuvel12',
            'nickname' => 'Rick van den Heuvel',
            'firstName' => 'Rick',
            'lastName' => 'van den Heuvel',
            'location' => 'OWB',
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'bbmeerlo',
            'email' => 'bb.meerlo@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'bbmeerlo',
            'nickname' => 'Bram-Boris Meerlo',
            'firstName' => 'Bram-Boris',
            'lastName' => 'Meerlo',
            'location' => 'OWB',
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'jbscholl',
            'email' => 'jb.schollaert@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'jbscholl',
            'nickname' => 'Jan Schollaert',
            'firstName' => 'Jan',
            'lastName' => 'Schollaert',
            'location' => 'OWB',
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'wdalton',
            'email' => 'w.dalton@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'wdalton',
            'nickname' => 'Waylon Dalton',
            'firstName' => 'Waylon',
            'lastName' => 'Dalton',
            'location' => 'OWB',
            'role' => 'student'
        ]);
        DB::table('users')->insert([
            'name' => 'jhenderson',
            'email' => 'j.henderson@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'jhenderson',
            'nickname' => 'Justine Henderson',
            'firstName' => 'Justine',
            'lastName' => 'Henderson',
            'location' => 'OWB',
            'role' => 'student'
        ]);
        DB::table('users')->insert([
            'name' => 'mcruz',
            'email' => 'm.Cruz@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'mcruz',
            'nickname' => 'Marcus Cruz',
            'firstName' => 'Marcus',
            'lastName' => 'Cruz',
            'location' => 'OWB',
            'role' => 'student'
        ]);
        DB::table('users')->insert([
            'name' => 'erand',
            'email' => 'e.Randolph@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'erand',
            'nickname' => 'Eddie Randolph',
            'firstName' => 'Eddie',
            'lastName' => 'Randolph',
            'location' => 'OWB',
            'role' => 'student'
        ]);
        DB::table('users')->insert([
            'name' => 'hahartman',
            'email' => 'h.Hartman@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'hahartman',
            'nickname' => 'Hadassah Hartman',
            'firstName' => 'Hadassah',
            'lastName' => 'Hartman',
            'location' => 'OWB',
            'role' => 'student'
        ]);
        DB::table('users')->insert([
            'name' => 'jsahffer',
            'email' => 'j.Shaffer@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'jsahffer',
            'nickname' => 'Joanna Shaffer',
            'firstName' => 'Joanna',
            'lastName' => 'Shaffer',
            'location' => 'OWB',
            'role' => 'student'
        ]);
        DB::table('users')->insert([
            'name' => 'taakesse',
            'email' => 'taa.vankessel@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'taakesse',
            'nickname' => 'taakesse',
            'firstName' => 'Tim',
            'lastName' => 'van Kessel',
            'location' => 'OWB',
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'tgapaans',
            'email' => 'tga.paans@student.avans.nl',
            'provider' => 'avans',
            'provider_id' => 'tgapaans',
            'nickname' => 'Tom Paans',
            'firstName' => 'Tom',
            'lastName' => 'Paans',
            'location' => 'OWB',
            'role' => 'admin'
        ]);
    }
}
