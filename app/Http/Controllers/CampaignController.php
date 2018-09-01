<?php

namespace App\Http\Controllers;

use App\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $campaigns = Campaign::visible()->get();

        return view('campaigns', ['campaigns' => $campaigns]);
    }

    public function apply($id, \App\Http\Requests\ApplyRequest $request)
    {
        $campaign = Campaign::find($id);
        $user = $request->user();

        if (! $campaign) {
            return redirect(route('campaigns'))->with('alert', 'A apărut o eroare la aplicare.');
        }

        if ($user->hasAppliedTo($campaign)) {
            return redirect(route('campaigns').'?jumpTo='.$campaign->id)->with('alert', 'Ai aplicat deja pentru această poziție!');
        }

        if (! $campaign->acceptsApplications()) {
            return redirect(route('campaigns'))->with('alert', 'Poziția pentru care ai aplicat nu mai este valabilă.');
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
            'question1' => $request->question1,
            'question2' => $request->question2,
            'question3' => $request->question3,
            'question4' => $request->question4,
            'status' => 'pending',
        ]);

        return redirect(route('campaigns').'?jumpTo='.$campaign->id)->with('success', 'Ai aplicat cu succes!');
    }
}
