<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearTestConfigCommand extends Command
{
    protected $signature = 'course:clear-test';

    protected $description = 'Clear env cache config';

    public function handle(): int
    {
        if (app()->isProduction()) {
            return self::FAILURE;
        }

        $this->call('config:cache', ['--env' => 'testing']);
        $this->call('config:clear');
        
        return self::SUCCESS;
    }
}
