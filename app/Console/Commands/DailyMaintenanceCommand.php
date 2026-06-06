<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DailyMaintenanceCommand extends Command
{
    protected $signature = 'maintenance:daily';

    protected $description = 'Daily maintenance: clear expired password reset tokens';

    public function handle(): int
    {
        $cutoff = now()->subHours(24)->timestamp;

        $count = User::where('time_req', '>', 0)
            ->where('time_req', '<', $cutoff)
            ->update(['token_req' => null, 'time_req' => 0]);

        $this->info("Cleared {$count} expired password reset token(s).");

        return self::SUCCESS;
    }
}
