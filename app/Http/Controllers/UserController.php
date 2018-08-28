<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['facebook', 'instagram', 'google'])->paginate(20);

        return view('users', ['users' => $users]);
    }

    public function show($idOrSlug, Request $request)
    {
        $user = User::with(['facebook', 'instagram', 'google'])->profile($idOrSlug)->firstOrFail();

        return view('user', ['user' => $user]);
    }

    public function me(Request $request)
    {
        return view('user', ['user' => $request->user()]);
    }

    public function updateMe(\App\Http\Requests\UpdateMeRequest $request)
    {
        $user = $request->user();

        $user->update([
            'profile_name' => ($request->profile_name) ? str_slug($request->profile_name) : $user->profile_name,
            'name' => ($request->name) ?: $user->name,
            'email' => ($request->email) ?: $user->email,
            'region' => ($request->region) ?: $user->region,
            'city' => ($request->city) ?: $user->city,
            'institution' => ($request->institution) ?: $user->institution,
            'starting_year' => ($request->starting_year) ?: $user->starting_year,
            'question1' => ($request->question1) ?: $user->question1,
            'question2' => ($request->question2) ?: $user->question2,
            'question3' => ($request->question3) ?: $user->question3,
            'question4' => ($request->question4) ?: $user->question4,
        ]);

        return redirect(route('me'))->with('success', 'Profilul de candidat a fost actualizat!');
    }
}
