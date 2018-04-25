<?php

namespace App\Console;

use App\Setting;
use App\Console\Commands\SendConceptMail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (Schema::hasTable('settings')) {
            $settings = Setting::all();
            $schedule
                ->job(SendConceptMail::class)
                ->when(function () {
                    return ((!empty($settings->conceptmailday) && $settings->conceptmailday->val == date('l')) || 'Sunday' == date('l'));
                })
                ->cron($this->getCron($settings));
        }
    }

    private function getCron($settings) {
        switch((!empty($settings->conceptmailfrequence) ? $settings->conceptmailfrequence->val : 'Weekly')) {
            case 'Monthly':
                return (!empty($settings->conceptmailtime) ? date('i H', strtotime($settings->conceptmailtime->val)) : '00 20') . ' 1 * *';
                break;
            case 'Weekly':
                return (!empty($settings->conceptmailtime) ? date('i H', strtotime($settings->conceptmailtime->val)) : '00 20') . ' * * 0';
                break;
            case 'Daily':
                return (!empty($settings->conceptmailtime) ? date('i H', strtotime($settings->conceptmailtime->val)) : '00 20') . ' * * *';
                break;
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
