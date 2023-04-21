<?php

namespace Tests\Feature;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        $statuses = Status::factory(20)
            ->forUser(['id' => 1])
            ->create();

        $response = $this->get('/feed');

        $response->assertSuccessful()
            ->assertSee('<?xml', false);
    }
}
