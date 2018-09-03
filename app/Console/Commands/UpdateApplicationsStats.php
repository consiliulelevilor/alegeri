<?php

namespace App\Console\Commands;

use App\Jobs\UpdateApplicationsStats as UpdateApplicationsStatsJob;
use Illuminate\Console\Command;

class UpdateApplicationsStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:stats:applications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the stats for applications which are meant to be stored in the cache system.';

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
        UpdateApplicationsStatsJob::dispatch(json_decode(file_get_contents(public_path('/json/regions.json'))))->onQueue('stats');
    }
}
