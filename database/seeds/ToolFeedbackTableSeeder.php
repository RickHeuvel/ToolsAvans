<?php

use Illuminate\Database\Seeder;

class ToolFeedbackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_feedback')->insert([
            'tool_slug' => 'github',
            'feedback' => 'De URL klopt niet. Nullam finibus sem elit, a cursus nulla tristique quis. Nulla ut diam nec lorem pretium volutpat eget sollicitudin mauris. Vivamus vel lectus mattis, tincidunt justo ut, elementum nulla. Pellentesque tellus eros, vulputate eu libero vitae, imperdiet eleifend mauris. Sed facilisis eget felis nec pellentesque. Nunc tristique arcu sit amet risus semper, ac iaculis ipsum efficitur. Nulla lobortis, orci id posuere tempor, nisi libero lacinia erat, eu iaculis dolor sem ac urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; ',
            'created_at' => now(),
        ]);
        DB::table('tool_feedback')->insert([
            'tool_slug' => 'google-drive',
            'feedback' => 'Logo niet goed. Nullam finibus sem elit, a cursus nulla tristique quis. Nulla ut diam nec lorem pretium volutpat eget sollicitudin mauris. Vivamus vel lectus mattis, tincidunt justo ut, elementum nulla. Pellentesque tellus eros, vulputate eu libero vitae, imperdiet eleifend mauris. Sed facilisis eget felis nec pellentesque. Nunc tristique arcu sit amet risus semper, ac iaculis ipsum efficitur. Nulla lobortis, orci id posuere tempor, nisi libero lacinia erat, eu iaculis dolor sem ac urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; ',
            'created_at' => now(),
        ]);
        DB::table('tool_feedback')->insert([
            'tool_slug' => 'heroku',
            'feedback' => 'Extra uitgebreide beschrijving nodig. Nullam finibus sem elit, a cursus nulla tristique quis. Nulla ut diam nec lorem pretium volutpat eget sollicitudin mauris. Vivamus vel lectus mattis, tincidunt justo ut, elementum nulla. Pellentesque tellus eros, vulputate eu libero vitae, imperdiet eleifend mauris. Sed facilisis eget felis nec pellentesque. Nunc tristique arcu sit amet risus semper, ac iaculis ipsum efficitur. Nulla lobortis, orci id posuere tempor, nisi libero lacinia erat, eu iaculis dolor sem ac urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; ',
            'created_at' => now(),
        ]);
    }
}