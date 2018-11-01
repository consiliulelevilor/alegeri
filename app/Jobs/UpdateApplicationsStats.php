<?php

namespace App\Jobs;

use App\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateApplicationsStats implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (! Cache::has('json:regions')) {
            Cache::put('json:regions', file_get_contents(public_path('/json/regions.json')), 90);
        }

        foreach (json_decode(cache('json:regions')) as $region => $cities) {
            $applications = Application::with('campaign')->where('user_region', $region)->get();

            Cache::put('stats:region:'.$region.':applications:total', $applications->count(), 90);
            Cache::put('stats:region:'.$region.':applications:pending', $applications->where('status', 'pending')->count(), 90);
            Cache::put('stats:region:'.$region.':applications:approved', $applications->where('status', 'approved')->count(), 90);
            Cache::put('stats:region:'.$region.':applications:declined', $applications->where('status', 'declined')->count(), 90);

            Cache::put('stats:region:'.$region.':applications:executive:total', $applications->where('campaign.type', 'executive')->count(), 90);
            Cache::put('stats:region:'.$region.':applications:executive:pending', $applications->where('campaign.type', 'executive')->where('status', 'pending')->count(), 90);
            Cache::put('stats:region:'.$region.':applications:executive:approved', $applications->where('campaign.type', 'executive')->where('status', 'approved')->count(), 90);
            Cache::put('stats:region:'.$region.':applications:executive:declined', $applications->where('campaign.type', 'executive')->where('status', 'declined')->count(), 90);

            Cache::put('stats:region:'.$region.':applications:executive-scholar:total', $applications->where('campaign.type', 'executive-scolar')->count(), 90);
            Cache::put('stats:region:'.$region.':applications:executive-scholar:pending', $applications->where('campaign.type', 'executive-scolar')->where('status', 'pending')->count(), 90);
            Cache::put('stats:region:'.$region.':applications:executive-scholar:approved', $applications->where('campaign.type', 'executive-scolar')->where('status', 'approved')->count(), 90);
            Cache::put('stats:region:'.$region.':applications:executive-scholar:declined', $applications->where('campaign.type', 'executive-scolar')->where('status', 'declined')->count(), 90);

            Cache::put('stats:region:'.$region.':applications:regional:total', $applications->where('campaign.type', 'regional')->count(), 9);
            Cache::put('stats:region:'.$region.':applications:regional:pending', $applications->where('campaign.type', 'regional')->where('status', 'pending')->count(), 90);
            Cache::put('stats:region:'.$region.':applications:regional:approved', $applications->where('campaign.type', 'regional')->where('status', 'approved')->count(), 90);
            Cache::put('stats:region:'.$region.':applications:regional:declined', $applications->where('campaign.type', 'regional')->where('status', 'declined')->count(), 90);
        }
    }
}
