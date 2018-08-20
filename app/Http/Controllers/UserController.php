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
        return view('profile', ['user' => $request->user()]);
    }
}
