<?php

use Illuminate\Database\Seeder;

class ToolTagLookupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_tag_lookup')->insert([
            'slug' => 'interne-tool',
            'name' => 'Interne tool',
            'default' => '0',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'externe-tool',
            'name' => 'Externe Tool',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'quiz',
            'name' => 'Quiz',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'programmeren',
            'name' => 'Programmeren',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'microsoft',
            'name' => 'Microsoft',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'computer',
            'name' => 'Voor je computer',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'telefoon',
            'name' => 'Voor je telefoon',
        ]);
        
        DB::table('tool_tag_lookup')->insert([
            'slug' => 'gratis',
            'name' => 'Gratis',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'betaald',
            'name' => 'Betaald',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'saas',
            'name' => 'SaaS',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'paas',
            'name' => 'PaaS',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'abonnement',
            'name' => 'Abonnement',
        ]);
    }
}
