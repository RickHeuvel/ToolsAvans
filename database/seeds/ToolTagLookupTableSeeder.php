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
            'slug' => 'intern',
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
            'slug' => 'desktop',
            'name' => 'Geschikt voor desktop',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'mobiel',
            'name' => 'Geschikt voor mobiel',
        ]);
        
        DB::table('tool_tag_lookup')->insert([
            'slug' => 'gratis',
            'name' => 'Gratis',
            'category_slug' => 'prijs',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'betaald',
            'name' => 'Betaald',
            'category_slug' => 'prijs',
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
            'category_slug' => 'prijs',
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

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'project',
            'name' => 'Project',
            'category_slug' => 'typeles',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'planning',
            'name' => 'Planning',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'workshop',
            'name' => 'Workshop',
            'category_slug' => 'typeles',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'uitvoer',
            'name' => 'Uitvoer',
            'category_slug' => 'typeles',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'voorbereiding',
            'name' => 'Voorbereiding',
            'category_slug' => 'typeles',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'webdevelopment',
            'name' => 'Web development',
            'category_slug' => 'typeles',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'webhosting',
            'name' => 'Web hosting',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'communicatie',
            'name' => 'Communicatie',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'versiebeheer',
            'name' => 'Versiebeheer',
        ]);

        DB::table('tool_tag_lookup')->insert([
            'slug' => 'video',
            'name' => 'Video',
        ]);
    }
}
