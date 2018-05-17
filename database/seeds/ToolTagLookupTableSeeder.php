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
            'pinned' => '1',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'externe-tool',
            'name' => 'Externe Tool',
            'pinned' => '1',
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
            'category_slug' => 'soortservice',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'paas',
            'name' => 'PaaS',
            'category_slug' => 'soortservice',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'abonnement',
            'name' => 'Abonnement',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'csharp',
            'name' => 'C#',
            'category_slug' => 'programmeertaal',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'java',
            'name' => 'Java',
            'category_slug' => 'programmeertaal',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'php',
            'name' => 'PHP',
            'category_slug' => 'programmeertaal',
        ]);
    }
}
