<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Jobs\UpdateApplicationsStats as UpdateApplicationsStatsJob;

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
        UpdateApplicationsStatsJob::dispatch()->onQueue('stats');

        $this->line('The application stats were updated!');
    }
}
