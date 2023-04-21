<?php

namespace Tests\Feature;

use App\Http\Livewire\StatusEdit;
use App\Http\Livewire\StatusForm;
use App\Http\Livewire\StatusIndex;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_create_admin(): void
    {
        $user = User::factory(1)->create(['id' => 1])->first();

        $this->actingAs($user);

        Livewire::test(StatusForm::class)
            ->set('content', 'test')
            ->call('create')
            ->assertSet('content', '')
            ->assertEmitted('statusCreated');

        $this->assertDatabaseHas('statuses', [
            'content' => 'test',
            'user_id' => 1,
        ]);
    }

    public function test_form_create_guest(): void
    {
        Livewire::test(StatusForm::class)
            ->set('content', 'test')
            ->call('create')
            ->assertForbidden()
            ->assertNotEmitted('statusCreated');

        $this->assertDatabaseMissing('statuses', [
            'content' => 'test',
            'user_id' => 1,
        ]);
    }

    public function test_index_created_event(): void
    {
        Livewire::test(StatusIndex::class)
            ->set('page', 2)
            ->emit('statusCreated')
            ->assertSet('page', 1);
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
            ->assertSeeText('edit');
    }

    public function test_show_guest(): void
    {
        $status = Status::factory(1)
            ->forUser()
            ->create()
            ->first();

        $response = $this->get(route('status.show', $status));

        $response->assertSuccessful()
            ->assertDontSeeText('edit');
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
            ->set('status.content', 'test')
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
            ->set('status.content', 'test')
            ->call('update')
            ->assertForbidden()
            ->assertNoRedirect();

        $this->assertDatabaseMissing('statuses', [
            'content' => 'test',
        ]);
    }
}
