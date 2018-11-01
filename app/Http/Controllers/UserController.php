<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        if (! Cache::has('json:regions')) {
            Cache::put('json:regions', file_get_contents(public_path('/json/regions.json')), 90);
        }

        if (! Cache::has('json:institutions')) {
            Cache::put('json:institutions', file_get_contents(public_path('/json/institutions.json')), 90);
        }
    }

    public function show($idOrSlug, Request $request)
    {
        $user = User::with([
            'facebook', 'instagram', 'google',
            'applications.campaign',
        ])->profile($idOrSlug)->firstOrFail();

        return view('user', ['user' => $user]);
    }

    public function users(Request $request)
    {
        $users = User::hasCompleteProfile()->latest()->paginate(15);

        if ($request->query('query')) {
            $users = User::search($request->query('query'))->orderBy('created_at', 'desc')->paginate(15);
        }

        return view('users', ['users' => $users]);
    }

    public function me(Request $request)
    {
        $request->user()->load([
            'facebook', 'instagram', 'google',
            'applications.campaign',
        ]);

        return view('user', ['user' => $request->user()]);
    }

    public function updateMe(\App\Http\Requests\UpdateMeRequest $request)
    {
        $user = $request->user();

        if ($request->region) {
            $cities = collect(json_decode(cache('json:regions'), true)[$request->region]);
            $institutions = json_decode(cache('json:institutions'), true)[$request->region];

            if ($request->city) {
                if (! $cities->where('name', $request->city)->first()) {
                    return redirect(route('me'))->with('alert', 'Orașul nu există în județul selectat.');
                }
            }

            if ($request->institution) {
                if (! in_array($request->institution, $institutions)) {
                    return redirect(route('me'))->with('alert', 'Școala sau liceul selectat nu există în județul selectat.');
                }
            }
        }

        $user->update([
            'profile_name' => ($request->profile_name) ? str_slug($request->profile_name) : $user->profile_name,
            'name' => ($request->name) ?: $user->name,
            'email' => ($request->email) ?: $user->email,
            'phone' => ($request->phone) ?: $user->phone,
            'region' => ($request->region) ?: $user->region,
            'city' => ($request->city) ?: $user->city,
            'institution' => ($request->institution) ?: $user->institution,
            'class' => ($request->class) ?: $user->class,
            'is_mail_subscribed' => $request->has('is_mail_subscribed'),
            'accepted_gdpr' => $request->has('accepted_gdpr'),
            'description' => ($request->description) ?: $user->description,
        ]);

        $user->load(['socials']);

        foreach ($user->socials as $social) {
            $user->{$social->social_type}->update([
                'is_public' => $request->has('make_'.$social->social_type.'_public'),
            ]);
        }

        return redirect(route('me'))->with('success', 'Profilul de candidat a fost actualizat!');
    }

    public function updateMyProfilePicture(\App\Http\Requests\UpdateMyProfilePictureRequest $request)
    {
        ini_set('upload_max_filesize', -1);
        ini_set('post_max_size', -1);

        $user = $request->user();

        if ($user->avatar_disk == 'public') {
            Storage::disk('public')->delete(public_path($user->avatar));
        }

        if (in_array($user->avatar_disk, ['gcs', 's3'])) {
            Storage::disk('gcs')->delete($user->avatar);
        }

        $user->update([
            'avatar' => Storage::putFile('', $request->file('profile_picture')),
            'avatar_disk' => config('filesystems.default'),
        ]);

        return redirect(route('me'))->with('success', 'Poza de profil a fost actualizată cu succes!');
    }

    public function updateMyCoverPicture(\App\Http\Requests\UpdateMyCoverPictureRequest $request)
    {
        ini_set('upload_max_filesize', -1);
        ini_set('post_max_size', -1);

        $user = $request->user();

        if ($user->cover_disk == 'public') {
            Storage::disk('public')->delete(public_path($user->cover));
        }

        if (in_array($user->cover_disk, ['gcs', 's3'])) {
            Storage::disk('gcs')->delete($user->cover);
        }

        $user->update([
            'cover' => Storage::putFile('', $request->file('cover_picture')),
            'cover_disk' => config('filesystems.default'),
        ]);

        return redirect(route('me'))->with('success', 'Poza de copertă a fost actualizată cu succes!');
    }
}
