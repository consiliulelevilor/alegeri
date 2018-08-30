<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class PurgeAssetsVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:version:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge the cached version number for assets on the frontend.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Cache::forget('v');

        $version = Cache::rememberForever('v', function () {
            return now()->format('U');
        });

        $this->line('The new assets version is now '.$version);
    }
}
