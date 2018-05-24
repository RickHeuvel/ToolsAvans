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
        if (!App::environment('production')) {
            $this->call([
                ToolCategoryTableSeeder::class,
                ToolStatusTableSeeder::class,
                UsersTableSeeder::class,
                ToolsTableSeeder::class,
                ToolImageTableSeeder::class,
                ReviewsTableSeeder::class,
                ToolFeedbackTableSeeder::class,
                TagCategoryTableSeeder::class,
                ToolTagLookupTableSeeder::class,
                ToolTagTableSeeder::class,
                ToolQuestionTableSeeder::class,
                ToolAnswerTableSeeder::class,
                ToolViewTableSeeder::class,
                SortOptionsTableSeeder::class,
                SettingsTableSeeder::class,
                ToolOutdatedReportsTableSeeder::class
            ]);
        } else {
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
                SortOptionsTableSeeder::class,
                SettingsTableSeeder::class
            ]);
        }
    }
}
