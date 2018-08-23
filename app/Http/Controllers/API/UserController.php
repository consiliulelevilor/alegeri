<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return responder()->success($request->user())->respond();
    }

    public function show($idOrSlug, Request $request)
    {
        $user = User::profile($idOrSlug)->firstOrFail();

        return responder()->success($user)->with('facebook', 'instagram', 'google')->respond();
    }
}
