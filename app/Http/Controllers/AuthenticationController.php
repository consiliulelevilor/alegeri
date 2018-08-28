<?php

namespace App\Http\Controllers;

use App\User;
use Socialite;
use App\UserSocial;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function index(Request $request)
    {
        return view('login');
    }

    public function social($social, Request $request)
    {
        if (! in_array($social, ['google', 'facebook', 'instagram'])) {
            return redirect(route('login'));
        }

        $scopes = [];

        if ($social == 'facebook') {
            $scopes = ['email'];
        }

        if ($social == 'instagram') {
            $scopes = ['basic'];
        }

        return Socialite::driver($social)->scopes($scopes)->redirect();
    }

    public function socialConfirmation($social, Request $request)
    {
        if (! in_array($social, ['google', 'facebook', 'instagram'])) {
            return redirect(route('login'));
        }

        $socialite = Socialite::driver($social)->user();
        $userSocial = UserSocial::{$social}()->socialId($socialite->getId())->first();

        // dd($socialite);
        if ($userSocial) {
            \Auth::login($userSocial->user()->first());

            $userSocial->update([
                'token' => $socialite->token,
                'token_expiry' => ($socialite->expiresIn) ? now()->addSeconds($socialite->expiresIn) : null,
                'socialite' => $socialite,
            ]);

            return redirect(route('home'));
        }

        if ($socialite->getEmail()) {
            $user = User::with(['facebook', 'google', 'instagram'])->email($socialite->getEmail())->first();

            if ($user) {
                if (! $user->{$social}) {
                    $user->socials()->create([
                        'social_id' => $socialite->getId(),
                        'social_type' => $social,
                        'email' => $socialite->getEmail(),
                        'nickname' => $socialite->getNickname(),
                        'name' => $socialite->getName(),
                        'avatar_url' => str_replace(['?sz=50', '?type=normal'], '?type=large', $socialite->getAvatar()),
                        'token' => $socialite->token,
                        'token_expiry' => ($socialite->expiresIn) ? now()->addSeconds($socialite->expiresIn) : null,
                        'socialite' => $socialite,
                    ]);

                    \Auth::login($user);

                    return redirect(route('me'));
                }
            }
        }

        $user = User::create([
            'email' => $socialite->getEmail(),
            'name' => $socialite->getName(),
        ]);

        $user->update([
            'profile_name' => str_slug($socialite->getName()).'-'.mt_rand(1000000, 9999999),
        ]);

        $user->socials()->create([
            'social_id' => $socialite->getId(),
            'social_type' => $social,
            'email' => $socialite->getEmail(),
            'nickname' => $socialite->getNickname(),
            'name' => $socialite->getName(),
            'avatar_url' => str_replace(['?sz=50', '?type=normal'], '?type=large', $socialite->getAvatar()),
            'token' => $socialite->token,
            'token_expiry' => ($socialite->expiresIn) ? now()->addSeconds($socialite->expiresIn) : null,
            'socialite' => $socialite,
        ]);

        \Auth::login($user);

        return redirect(route('me'));
    }

    public function logout(Request $request)
    {
        \Auth::logout();

        return redirect(route('home'));
    }
}
