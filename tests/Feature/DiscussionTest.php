<?php

namespace Tests\Feature;

use App\Livewire\AnswerCreate;
use App\Livewire\DiscussionCreate;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DiscussionTest extends TestCase
{
    use RefreshDatabase;

    public function test_discussion_index_guest(): void
    {
        $discussions = Discussion::factory(50)
            ->forUser()
            ->create();

        $response = $this->get(route('discussion'));

        $response->assertStatus(200)
            ->assertDontSee('>公開質問<', false);
    }

    public function test_discussion_index_admin(): void
    {
        $discussions = Discussion::factory(10)
            ->forUser(['id' => 1])
            ->create();

        $response = $this->actingAs($discussions->first()->user)
            ->get(route('discussion'));

        $response->assertStatus(200)
            ->assertSee('>非公開質問<', false);
    }

    public function test_discussion_index_other(): void
    {
        $discussions = Discussion::factory(10)
            ->forUser(['id' => 2])
            ->create();

        $response = $this->actingAs($discussions->first()->user)
            ->get(route('discussion'));

        $response->assertStatus(200)
            ->assertDontSee('>非公開質問<', false)
            ->assertSee('>自分の質問<', false);
    }

    public function test_discussion_show(): void
    {
        $discussion = Discussion::factory(1)
            ->forUser()
            ->create()
            ->first();

        $response = $this->get(route('discussion.show', $discussion));

        $response->assertStatus(200)
            ->assertSee($discussion->content);
    }

    public function test_discussion_my(): void
    {
        $discussion = Discussion::factory(1)
            ->forUser()
            ->create()
            ->first();

        $response = $this->actingAs($discussion->user)
            ->get(route('discussion.my'));

        $response->assertStatus(200)
            ->assertSee($discussion->title);
    }

    public function test_discussion_private(): void
    {
        $discussion = Discussion::factory(1)
            ->forUser()
            ->create([
                'private' => true,
            ])
            ->first();

        $response = $this->actingAs($discussion->user)
            ->get(route('discussion.private'));

        $response->assertStatus(200)
            ->assertSee($discussion->title);
    }

    public function test_discussion_show_private(): void
    {
        $discussion = Discussion::factory(1)
            ->forUser(['id' => 2])
            ->create([
                'private' => true,
            ])
            ->first();

        $response = $this->actingAs($discussion->first()->user)
            ->get(route('discussion.show', $discussion));

        $response->assertSuccessful()
            ->assertSee($discussion->content);
    }

    public function test_discussion_show_private_admin(): void
    {
        $discussion = Discussion::factory(1)
            ->forUser(['id' => 1])
            ->create([
                'private' => true,
            ])
            ->first();

        $response = $this->actingAs($discussion->first()->user)
            ->get(route('discussion.show', $discussion));

        $response->assertSuccessful()
            ->assertSee($discussion->content);
    }

    public function test_discussion_show_private_guest(): void
    {
        $discussion = Discussion::factory(1)
            ->forUser()
            ->create([
                'private' => true,
            ])
            ->first();

        $response = $this->get(route('discussion.show', $discussion));

        $response->assertForbidden();
    }

    public function test_discussion_create(): void
    {
        Livewire::actingAs($user = User::factory()->create())
            ->test(DiscussionCreate::class)
            ->set('title', 'test')
            ->set('content', 'test')
            ->set('version', '10.x')
            ->set('private', true)
            ->call('create');

        $this->assertDatabaseHas('discussions', [
            'title' => 'test',
            'content' => 'test',
            'version' => '10.x',
            'private' => true,
            'user_id' => $user->id,
        ]);
    }

    public function test_answer_create_user(): void
    {
        $discussion = Discussion::factory(1)
            ->forUser()
            ->create()
            ->first();

        Livewire::actingAs($user = User::factory()->create())
            ->test(AnswerCreate::class, ['discussion' => $discussion])
            ->set('content', 'test')
            ->call('create');

        $this->assertDatabaseHas('answers', [
            'content' => 'test',
            'user_id' => $user->id,
            'discussion_id' => $discussion->id,
        ]);
    }

    public function test_answer_create_guest(): void
    {
        $discussion = Discussion::factory(1)
            ->forUser()
            ->create()
            ->first();

        Livewire::test(AnswerCreate::class, ['discussion' => $discussion])
            ->set('content', 'test')
            ->call('create');

        $this->assertDatabaseHas('answers', [
            'content' => 'test',
            'user_id' => null,
            'discussion_id' => $discussion->id,
        ]);
    }
}
