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
            ReviewsTableSeeder::class,
            ToolFeedbackTableSeeder::class,
            ToolSpecificationLookupTableSeeder::class,
            ToolSpecificationsTableSeeder::class,
        ]);
    }
}
