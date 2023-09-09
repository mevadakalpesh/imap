<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ApiPath extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:api-path';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'for set API Path ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('migrate:reset');
    }
}
