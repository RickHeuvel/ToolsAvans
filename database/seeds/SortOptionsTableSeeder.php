<?php

use Illuminate\Database\Seeder;

class SortOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sortoptions')->insert([
            'name' => 'Views oplopend',
            'type' => 'views_count',
            'direction' => 'desc',
            'icon' => 'fa fa-sort-amount-desc'
        ]);

        DB::table('sortoptions')->insert([
            'name' => 'Views aflopend',
            'type' => 'views_count',
            'direction' => 'asc',
            'icon' => 'fa fa-sort-amount-asc'
        ]);

        DB::table('sortoptions')->insert([
            'name' => 'Datum oplopend',
            'type' => 'created_at',
            'direction' => 'desc',
            'icon' => 'fa fa-sort-numeric-desc'
        ]);

        DB::table('sortoptions')->insert([
            'name' => 'Datum aflopend',
            'type' => 'created_at',
            'direction' => 'asc',
            'icon' => 'fa fa-sort-numeric-asc'
        ]);

        DB::table('sortoptions')->insert([
            'name' => 'Naam oplopend',
            'type' => 'name',
            'direction' => 'desc',
            'icon' => 'fa fa-sort-alpha-desc'
        ]);

        DB::table('sortoptions')->insert([
            'name' => 'Naam aflopend',
            'type' => 'name',
            'direction' => 'asc',
            'icon' => 'fa fa-sort-alpha-asc'
        ]);
    }
}
