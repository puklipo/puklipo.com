<?php

namespace Tests\Feature;

use App\Livewire\StatusCreate;
use App\Livewire\StatusEdit;
use App\Livewire\StatusIndex;
use App\Models\Status;
use App\Models\User;
use App\Support\IndexNow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_create_admin(): void
    {
        IndexNow::fake();
        Http::preventStrayRequests();

        $user = User::factory(1)->create(['id' => 1])->first();

        $this->actingAs($user);

        Livewire::test(StatusCreate::class)
            ->set('content', 'test')
            ->set('title', 'test')
            ->call('create')
            ->assertSet('content', '')
            ->assertDispatched('statusCreated');

        $this->assertDatabaseHas('statuses', [
            'content' => 'test',
            'title' => 'test',
            'user_id' => 1,
        ]);

        Http::assertSentCount(0);
    }

    public function test_form_create_guest(): void
    {
        Livewire::test(StatusCreate::class)
            ->set('content', 'test')
            ->call('create')
            ->assertForbidden()
            ->assertNotDispatched('statusCreated');

        $this->assertDatabaseMissing('statuses', [
            'content' => 'test',
            'user_id' => 1,
        ]);
    }

    public function test_index_created_event(): void
    {
        Livewire::test(StatusIndex::class)
            ->set('paginators', ['page' => 2])
            ->dispatch('statusCreated')
            ->assertSet('paginators', ['page' => 1]);
    }

    public function test_show_admin(): void
    {
        $status = Status::factory(1)
            ->forUser()
            ->create()
            ->first();

        $response = $this->actingAs($status->user)
            ->get(route('status.show', $status));

        $response->assertSuccessful()
            ->assertSee(route('status.edit', $status));
    }

    public function test_show_guest(): void
    {
        $status = Status::factory(1)
            ->forUser()
            ->create()
            ->first();

        $response = $this->get(route('status.show', $status));

        $response->assertSuccessful()
            ->assertDontSee(route('status.edit', $status));
    }

    public function test_edit_admin(): void
    {
        $status = Status::factory(1)
            ->forUser()
            ->create()
            ->first();

        $response = $this->actingAs($status->user)
            ->get(route('status.edit', $status));

        $response->assertSuccessful();
    }

    public function test_edit_guest(): void
    {
        $status = Status::factory(1)
            ->forUser()
            ->create()
            ->first();

        $response = $this->get(route('status.edit', $status));

        $response->assertForbidden();
    }

    public function test_edit_update_admin(): void
    {
        $status = Status::factory(1)
            ->forUser(['id' => 1])
            ->create()
            ->first();

        $this->actingAs($status->user);

        Livewire::test(StatusEdit::class, ['status' => $status])
            ->set('content', 'test')
            ->call('update')
            ->assertRedirect();

        $this->assertDatabaseHas('statuses', [
            'content' => 'test',
        ]);
    }

    public function test_edit_update_guest(): void
    {
        $status = Status::factory(1)
            ->forUser()
            ->create()
            ->first();

        Livewire::test(StatusEdit::class, ['status' => $status])
            ->set('content', 'test')
            ->call('update')
            ->assertForbidden()
            ->assertNoRedirect();

        $this->assertDatabaseMissing('statuses', [
            'content' => 'test',
        ]);
    }

    public function test_edit_delete_admin(): void
    {
        $status = Status::factory(1)
            ->forUser(['id' => 1])
            ->create()
            ->first();

        $this->actingAs($status->user);

        Livewire::test(StatusEdit::class, ['status' => $status])
            ->call('delete')
            ->assertRedirect();

        $this->assertDatabaseMissing('statuses', [
            'id' => $status->id,
        ]);
    }

    public function test_edit_delete_guest(): void
    {
        $status = Status::factory(1)
            ->forUser(['id' => 1])
            ->create()
            ->first();

        Livewire::test(StatusEdit::class, ['status' => $status])
            ->call('delete')
            ->assertForbidden();

        $this->assertDatabaseHas('statuses', [
            'id' => $status->id,
        ]);
    }
}
