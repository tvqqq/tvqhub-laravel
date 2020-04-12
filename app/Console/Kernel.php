<?php

namespace App\Console;

use App\Console\Commands\DeepTumblr;
use App\Console\Commands\FbAutoLike;
use App\Console\Commands\SlackWebhook;
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
        $schedule->command(SlackWebhook::class)
            ->dailyAt('6:00');

        $schedule->command(FbAutoLike::class)
            ->hourly()->between('7:00', '22:00')->runInBackground();

        $schedule->command(DeepTumblr::class)
            ->everyFifteenMinutes()->between('12:00', '24:00')->runInBackground();
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
