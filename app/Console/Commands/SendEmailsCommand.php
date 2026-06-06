<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Compatibility stub — replaced by Laravel queue worker in TASK-20.
 *
 * CI3 sent emails via HTTP cron to /Cronjob, which read tbemail and dispatched
 * via SMTP2Go or internal SMTP. TASK-20 replaced this with Mail::to()->queue()
 * backed by the database queue driver. Run `php artisan queue:work` to process.
 */
class SendEmailsCommand extends Command
{
    protected $signature = 'emails:send';

    protected $description = 'Compatibility stub — email delivery is handled by php artisan queue:work';

    public function handle(): int
    {
        $this->info('Email delivery is managed by the Laravel queue worker.');
        $this->info('Start the worker with: php artisan queue:work');

        return self::SUCCESS;
    }
}
