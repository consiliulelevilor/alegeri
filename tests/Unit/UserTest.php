<?php

namespace Tests\Unit;

use App\User;
use App\Campaign;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testSocials()
    {
        $user = factory(User::class)->create();

        $this->assertEquals($user->socials()->count(), 0);
        $this->assertEquals($user->facebook()->count(), 0);
        $this->assertEquals($user->google()->count(), 0);
        $this->assertEquals($user->instagram()->count(), 0);
    }

    public function testApplications()
    {
        $user = factory(User::class)->create();

        $this->assertEquals($user->applications()->count(), 0);
    }

    public function testScopes()
    {
        $user = factory(User::class)->create();

        $this->assertEquals(User::email($user->email)->value('email'), $user->email);
        $this->assertEquals(User::profile($user->id)->value('id'), $user->id);
        $this->assertEquals(User::profile($user->profile_name)->value('id'), $user->id);
    }

    public function testAvatar()
    {
        $user = factory(User::class)->create();

        $this->assertNull($user->avatarUrl());

        $user->update([
            'avatar' => 'https://via.placeholder.com/64x64',
        ]);
        $this->assertEquals($user->avatar, 'https://via.placeholder.com/64x64');
    }

    public function testSubmitToCampaign()
    {
        $user = factory(User::class)->create([
            'institution' => null,
        ]);
        $campaign = factory(Campaign::class)->create();

        $this->assertFalse($user->canApplyToCampaigns());
        $this->assertFalse($user->hasAppliedTo($campaign));

        $user->update([
            'institution' => 'Școala cu clasele X',
        ]);

        $this->assertTrue($user->canApplyToCampaigns());

        $application = $user->applications()->create([
            'campaign_id' => $campaign->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_city' => $user->city,
            'user_region' => $user->region,
            'user_institution' => $user->institution,
            'user_class' => $user->class,
            'user_description' => $user->description,
            'question1' => 'Just a bunch of questions here.',
            'question2' => 'Just a bunch of questions here.',
            'question3' => 'Just a bunch of questions here.',
            'question4' => 'Just a bunch of questions here.',
            'question5' => 'Just a bunch of questions here.',
            'status' => 'pending',
        ]);

        $this->assertTrue($application->campaign()->first()->is($campaign));
        $this->assertTrue($application->user()->first()->is($user));
        $this->assertTrue($application->isPending());

        $this->assertTrue($user->hasAppliedTo($campaign));
        $this->assertEquals($campaign->applications()->count(), 1);
        $this->assertTrue($campaign->applicants()->first()->is($user));
    }
}
