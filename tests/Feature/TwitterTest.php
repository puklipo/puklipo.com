<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TwitterTest extends TestCase
{
    use RefreshDatabase;

    public function test_webhook(): void
    {
        $user = User::factory(1)->create()->first();

        $response = $this->actingAs($user)->postJson(route('twitter.webhook'), [
            'content' => 'test',
            'link' => 'http://localhost/status/1',
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('statuses', [
            'content' => 'test',
            'twitter' => 'http://localhost/status/1',
        ]);
    }

    public function test_webhook_guest(): void
    {
        $response = $this->postJson(route('twitter.webhook'), [
            'content' => 'test',
            'link' => 'http://localhost/status/1',
        ]);

        $response->assertUnauthorized();

        $this->assertDatabaseMissing('statuses', [
            'content' => 'test',
            'twitter' => 'http://localhost/status/1',
        ]);
    }
}
