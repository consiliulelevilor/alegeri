<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class UpdateCachedData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:cached';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the data that is stored in the caching system.';

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
        $regions = file_get_contents(public_path('/json/regions.json'));
        $institutions = file_get_contents(public_path('/json/institutions.json'));

        Cache::rememberForever('json:regions:raw', function () use ($regions) {
            return $regions;
        });

        Cache::rememberForever('json:regions', function () use ($regions) {
            return json_decode($regions);
        });

        Cache::rememberForever('json:institutions:raw', function () use ($institutions) {
            return $institutions;
        });

        Cache::rememberForever('json:institutions', function () use ($institutions) {
            return json_decode($institutions);
        });

        $this->line('Cached data was updated!');
    }
}
