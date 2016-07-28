<?php

namespace App\Console;

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
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\DataMigration::class,
        \App\Console\Commands\MeetingRoomsImagesMigration::class,
        \App\Console\Commands\VoImages::class,
        \App\Console\Commands\GenerateApiKey::class,        

        \App\Console\Commands\SpaceTypesSeeder::class,
        \App\Console\Commands\OwnersSeeder::class,
        \App\Console\Commands\AwsImagesSeoDataMigration::class,
        \App\Console\Commands\LocationSocialMetaDataMigration::class,
       

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->hourly();
    }
}
