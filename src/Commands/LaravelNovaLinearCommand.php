<?php

namespace LaravelNovaLinear\Commands;

use Illuminate\Console\Command;

class LaravelNovaLinearCommand extends Command
{
    public $signature = 'laravel-nova-linear';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
