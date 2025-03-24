<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AccessLink;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CleanExpiredLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'links:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired access links';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expirationMinutes = (int) config('settings.link_expiration_minutes', 7 * 24 * 60);
        $cutoff = now()->subMinutes($expirationMinutes);
        AccessLink::where('expires_at', '<=', $cutoff)->delete();
    }


}
