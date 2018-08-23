<?php

namespace App\Transformers;

use Flugg\Responder\Transformers\Transformer;

class UserTransformer extends Transformer {
    
    protected $relations = [

    ];

    public function transform($user): array
    {
        if (! $user) {
            return [];
        }

        return [
            'id' => $user->id,
            'profile_name' => $user->profile_name,
            'description' => $user->description,
            'identity' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'avatar_url' => $user->avatarUrl(),
            ],
            'location' => [
                'city' => $user->city,
                'region' => $user->region,
            ],
            'education' => [
                'institution' => $user->institution,
                'starting_year' => $user->starting_year,
            ],
            'is' => [
                'admin' => $user->is_admin,
                'subscribed' => $user->is_subscribed,
                'confirmed' => is_null($user->activation_token),
            ],
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'deleted_at' => $user->deleted_at,
            'is_deleted' => ! is_null($user->deleted_at),
        ];
    }

    public function includeFacebook(User $user)
    {
        return $user->facebook;
    }

    public function includeGoogle(User $user)
    {
        return $user->google;
    }

    public function includeInstagram(User $user)
    {
        return $user->instagram;
    }
}