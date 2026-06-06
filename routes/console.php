<?php

use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Console Schedule
|--------------------------------------------------------------------------
|
| System cron entry (single entry on the server):
|   * * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
|
| Email delivery runs via the queue worker (not schedule:run):
|   php artisan queue:work
|
*/

// Clean expired password reset tokens daily at midnight.
Schedule::command('maintenance:daily')->dailyAt('00:00');

// Compatibility stub — email delivery is handled by queue:work, not this command.
Schedule::command('emails:send')->everyMinute();
