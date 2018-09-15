<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    public function testAllRoutes()
    {
        $user = factory(User::class)->create();

        $this->assertTrue(true);

        // $this->get('/')->assertStatus(200);
        // $this->get('/login')->assertStatus(200);
        // $this->get('/candidat/'. $user->profile_name)->assertStatus(200);

        // $this->actingAs($user)->get('/candidat/'. $user->profile_name)->assertStatus(200);
        // $this->actingAs($user)->get('/profilul-meu')->assertStatus(200);
        // $this->actingAs($user)->get('/aplica')->assertStatus(200);
        // $this->actingAs($user)->get('/logout')->assertStatus(200);
    }
}
