<?php

namespace App\Console;

use App\Console\Commands\Email;
use App\Console\Commands\LastMovies;
use App\Console\Commands\Youtube;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package App\Console
 */
class Kernel extends ConsoleKernel
{
    
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        LastMovies::class,
        Youtube::class,
        Email::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('email:send zuzu38080@gmail.com Boyer')
                 ->everyMinute();
    }
}
