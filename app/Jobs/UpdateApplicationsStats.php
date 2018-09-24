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
        foreach (Cache::get('json:regions') as $region => $cities) {
            $applications = Application::with('campaign')->where('user_region', $region)->get();

            Cache::put('stats:region:'.$region.':applications:total', $applications->count(), 60);
            Cache::put('stats:region:'.$region.':applications:pending', $applications->where('status', 'pending')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:approved', $applications->where('status', 'approved')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:declined', $applications->where('status', 'declined')->count(), 60);

            Cache::put('stats:region:'.$region.':applications:executive:total', $applications->where('campaign.type', 'executive')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:executive:pending', $applications->where('campaign.type', 'executive')->where('status', 'pending')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:executive:approved', $applications->where('campaign.type', 'executive')->where('status', 'approved')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:executive:declined', $applications->where('campaign.type', 'executive')->where('status', 'declined')->count(), 60);

            Cache::put('stats:region:'.$region.':applications:executive-scholar:total', $applications->where('campaign.type', 'executive-scolar')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:executive-scholar:pending', $applications->where('campaign.type', 'executive-scolar')->where('status', 'pending')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:executive-scholar:approved', $applications->where('campaign.type', 'executive-scolar')->where('status', 'approved')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:executive-scholar:declined', $applications->where('campaign.type', 'executive-scolar')->where('status', 'declined')->count(), 60);

            Cache::put('stats:region:'.$region.':applications:regional:total', $applications->where('campaign.type', 'regional')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:regional:pending', $applications->where('campaign.type', 'regional')->where('status', 'pending')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:regional:approved', $applications->where('campaign.type', 'regional')->where('status', 'approved')->count(), 60);
            Cache::put('stats:region:'.$region.':applications:regional:declined', $applications->where('campaign.type', 'regional')->where('status', 'declined')->count(), 60);
        }
    }
}
