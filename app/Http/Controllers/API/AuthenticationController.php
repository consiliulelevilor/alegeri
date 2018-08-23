<?php

namespace App\Http\Controllers\API;

use App\User;
use Socialite;
use App\UserSocial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    public function social($social, Request $request)
    {
        if (! in_array($social, ['google', 'facebook', 'instagram'])) {
            return responder()->error()->respond(500);
        }

        $scopes = [];

        if ($social == 'facebook') {
            $scopes = ['email'];
        }

        if ($social == 'instagram') {
            $scopes = ['basic'];
        }

        return Socialite::driver($social)->scopes($scopes)->stateless()->redirect();
    }

    public function socialConfirmation($social, Request $request)
    {
        if (! in_array($social, ['google', 'facebook', 'instagram'])) {
            return redirect(env('FRONTEND_URL').'/login');
        }

        $socialite = Socialite::driver($social)->stateless()->user();
        $userSocial = UserSocial::{$social}()->socialId($socialite->getId())->first();

        if ($userSocial) {
            $userSocial->update([
                'token' => $socialite->token,
                'token_expiry' => ($socialite->expiresIn) ? now()->addSeconds($socialite->expiresIn) : null,
                'socialite' => $socialite,
            ]);

            $user = $userSocial->user()->first();

            return redirect(env('FRONTEND_URL').'/login/confirmation?withToken='.$user->createToken('socialite')->accessToken);
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

                    return redirect(env('FRONTEND_URL').'/login/confirmation?withToken='.$user->createToken('socialite')->accessToken);
                }
            }
        }

        $user = User::create([
            'email' => $socialite->getEmail(),
            'first_name' => $socialite->getName(),
            'last_name' => null,
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

        return redirect(env('FRONTEND_URL').'/login/confirmation?withToken='.$user->createToken('socialite')->accessToken);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->delete();

        return responder()->succes()->respond();
    }
}
