<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $user = User::factory()
            ->hasStatuses(20)
            ->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200)
            ->assertSeeLivewire('status-form')
            ->assertSeeLivewire('status-index');
    }
}
