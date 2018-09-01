<?php

namespace App\Http\Controllers;

use App\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($request->query('campaignId')) {
            $campaign = Campaign::find($request->query('campaignId'));

            if ($request->query('apply')) {
                if (! $campaign) {
                    return redirect(route('campaigns'))->with('alert', 'A apărut o eroare la aplicarea campaniei.');
                }

                if ($user->hasAppliedTo($campaign)) {
                    return redirect(route('campaigns'))->with('alert', 'Ai aplicat deja la această poziție!');
                }

                if (! $campaign->acceptsApplications()) {
                    return redirect(route('campaigns'))->with('alert', 'Poziția pentru care ai aplicat nu mai este disponibilă.');
                }

                $user->applications()->create([
                    'campaign_id' => $campaign->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'user_city' => $user->city,
                    'user_region' => $user->region,
                    'user_institution' => $user->institution,
                    'user_starting_year' => $user->starting_year,
                    'user_description' => $user->description,
                    'user_question1' => $user->question1,
                    'user_question2' => $user->question2,
                    'user_question3' => $user->question3,
                    'user_question4' => $user->question4,
                    'status' => 'pending',
                ]);

                return redirect(route('campaigns').'?jumpTo='.$campaign->id)->with('success', 'Ai aplicat cu succes!');
            }
        }

        $campaigns = Campaign::visible()->get();

        return view('campaigns', ['campaigns' => $campaigns]);
    }
}
