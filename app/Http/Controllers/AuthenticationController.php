<?php

namespace App\Http\Controllers;

use Session;
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

        if ($request->user()) {
            if (! $request->query('link')) {
                return redirect(route('me'));
            }

            Session::put('user_id', $request->user()->id);
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
        $sessionedUser = User::with(['facebook', 'google', 'instagram'])->find(Session::get('user_id'));

        Session::forget('user_id');

        if ($userSocial) {
            $user = $userSocial->user()->first();

            if ($sessionedUser) {
                if (! $user->is($sessionedUser)) {
                    return redirect(route('me'))->with('alert', 'Contul de '.ucfirst($social).' este deja asociat cu alt cont.');
                }
            }

            \Auth::login($user);

            $userSocial->update([
                'token' => $socialite->token,
                'token_expiry' => ($socialite->expiresIn) ? now()->addSeconds($socialite->expiresIn) : null,
                'socialite' => $socialite,
            ]);

            if (! $user->canApplyToCampaigns()) {
                return redirect(route('me').'?open=profile');
            }

            return redirect(route('me'))->with('success', 'Bine ai revenit în contul tău!');
        }

        if ($sessionedUser) {
            if ($sessionedUser->{$social}) {
                return redirect(route('me'))->with('alert', 'Contul de '.ucfirst($social).' este deja asociat contului!');
            }

            $sessionedUser->socials()->create([
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

            \Auth::login($sessionedUser);

            if (! $sessionedUser->canApplyToCampaigns()) {
                return redirect(route('me').'?open=profile');
            }

            return redirect(route('me'))->with('success', 'Contul de '.ucfirst($social).' a fost adăugat!');
        }

        $user = User::with(['facebook', 'google', 'instagram'])->email($socialite->getEmail())->first();

        if (! $user) {
            $user = User::create([
                'email' => $socialite->getEmail(),
                'name' => $socialite->getName(),
                'profile_name' => str_slug($socialite->getName()).'-'.mt_rand(1000000, 9999999),
                'avatar' => asset('/images/profile/patrick.png'),
            ]);

            $user->load(['facebook', 'google', 'instagram']);
        }

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

            if (! $user->canApplyToCampaigns()) {
                return redirect(route('me').'?open=profile');
            }

            return redirect(route('me'))->with('success', 'Bine ai revenit în contul tău!');
        }

        return redirect(route('me').'?open=profile');
    }

    public function socialUnlink($social, Request $request)
    {
        if (! in_array($social, ['google', 'facebook', 'instagram'])) {
            return redirect(route('me'));
        }

        $user = $request->user();

        $user->load(['facebook', 'google', 'instagram', 'socials']);

        if (! $user->{$social}) {
            return redirect(route('me'));
        }

        if ($user->socials->count() == 1) {
            return redirect(route('me'))->with('alert', 'Nu poți șterge ultima metodă de autentificare rămasă.');
        }

        $user->{$social}->forceDelete();

        return redirect(route('me'))->with('success', 'Contul de '.ucfirst($social).' a fost șters!');
    }

    public function logout(Request $request)
    {
        \Auth::logout();

        return redirect(route('home'));
    }
}
