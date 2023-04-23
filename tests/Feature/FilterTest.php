<?php

namespace Tests\Feature;

use App\Http\Livewire\StatusFilter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_filter(): void
    {
        Livewire::test(StatusFilter::class)
            ->call('filterChange', 1)
            ->assertSessionHas('status_filter')
            ->assertEmitted('statusCreated', true);
    }

    public function test_filter_failed(): void
    {
        Livewire::test(StatusFilter::class)
            ->call('filterChange', 100)
            ->assertSessionMissing('status_filter')
            ->assertNotEmitted('statusCreated', true);
    }
}
