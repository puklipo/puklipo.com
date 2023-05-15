<?php

namespace Tests\Feature;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap(): void
    {
        Status::factory(20)
            ->forUser()
            ->create();

        $response = $this->get(route('sitemap'));

        $response->assertStatus(200);
    }
}
