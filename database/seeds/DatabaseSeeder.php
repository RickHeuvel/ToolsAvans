<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ToolCategoryTableSeeder::class,
            ToolStatusTableSeeder::class,
            UsersTableSeeder::class,
            ToolsTableSeeder::class,
            ToolImageTableSeeder::class,
            TagCategoryTableSeeder::class,
            ToolTagLookupTableSeeder::class,
            ToolTagTableSeeder::class,
            ToolViewTableSeeder::class,
            SettingsTableSeeder::class,
            AcademyLookupTableSeeder::class,
            ToolAcademyTableSeeder::class
        ]);

        if (!App::environment('production')) {
            $this->call([
                ReviewsTableSeeder::class,
                ToolFeedbackTableSeeder::class,
                ToolQuestionTableSeeder::class,
                ToolAnswerTableSeeder::class,
                PageViewTableSeeder::class,
                ToolOutdatedReportsTableSeeder::class,
            ]);
        }
    }
}
