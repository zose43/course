<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Leeto\MoonShine\Models\MoonshineUser;

class RefreshCommand extends Command
{
    protected $signature = 'course:refresh';

    protected $description = 'Refresh data';

    public function handle(): int
    {
        if (app()->isProduction()) {
            return self::FAILURE;
        }

        $dirs = [
            storage_path('/app/public/images/brands'),
            storage_path('/app/public/images/products'),
        ];

        $this->call('cache:clear');

        foreach ($dirs as $dir) {
            File::cleanDirectory($dir);
        }

        $this->call('migrate:fresh', ['--seed' => true]);
        MoonshineUser::query()->create([
            'email' => 'admin@ya.ru',
            'name' => 'zose',
            'password' => Hash::make('zose'),
        ]);

        return self::SUCCESS;
    }
}
