<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

#[Signature('scheduler:test')]
#[Description('Test scheduler execution')]
class TestScheduler extends Command
{
    public function handle()
    {
        Log::info('Scheduler executed successfully');

        return self::SUCCESS;
    }
}
