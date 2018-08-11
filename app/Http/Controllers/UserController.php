<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function viewUsers(Request $request)
    {
        $users = User::with(['facebook', 'instagram', 'google'])->paginate(20);

        return view('users', ['users' => $users]);
    }

    public function viewUser(Request $request, $idOrSlug)
    {
        $user = User::with(['facebook', 'instagram', 'google'])->profile($idOrSlug)->firstOrFail();

        return view('profile', ['user' => $user]);
    }
}
