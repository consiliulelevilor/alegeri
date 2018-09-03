<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
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
        $user->load(['facebook', 'google', 'instagram']);

        $user->update([
            'profile_name' => ($request->profile_name) ? str_slug($request->profile_name) : $user->profile_name,
            'name' => ($request->name) ?: $user->name,
            'email' => ($request->email) ?: $user->email,
            'region' => ($request->region) ?: $user->region,
            'city' => ($request->city) ?: $user->city,
            'institution' => ($request->institution) ?: $user->institution,
            'starting_year' => ($request->starting_year) ?: $user->starting_year,
            'is_mail_subscribed' => $request->has('is_mail_subscribed'),
            'description' => ($request->description) ?: $user->description,
        ]);

        if ($user->facebook) {
            $user->facebook->update([
                'is_public' => $request->has('make_facebook_public'),
            ]);
        }

        if ($user->google) {
            $user->google->update([
                'is_public' => $request->has('make_google_public'),
            ]);
        }

        if ($user->instagram) {
            $user->instagram->update([
                'is_public' => $request->has('make_instagram_public'),
            ]);
        }

        return redirect(route('me'))->with('success', 'Profilul de candidat a fost actualizat!');
    }

    public function updateMyProfilePicture(\App\Http\Requests\UpdateMyProfilePictureRequest $request)
    {
        ini_set('upload_max_filesize', -1);
        ini_set('post_max_size', -1);

        $user = $request->user();

        if ($user->avatar && ! filter_var($user->avatar, FILTER_VALIDATE_URL)) {
            Storage::delete(public_path($user->avatar));
        }

        $user->update([
            'avatar' => $request->file('profile_picture')->store('users/upload'),
        ]);

        return redirect(route('me'))->with('success', 'Poza de profil a fost actualizată cu succes!');
    }
}
