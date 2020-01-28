<?php

namespace Tests\Feature\Team\Candidates;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SendCandidateRequestsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_send_candidate_requests()
    {
        $candidate = factory(User::class)->create();

        $this->post("/candidates/{$candidate->id}")->assertRedirect('login');
    }

    /** @test */
    public function users_cannot_send_candidate_requests()
    {
        $candidate = factory(User::class)->create();

        $this->signIn()
            ->post("/candidates/{$candidate->id}")
            ->assertRedirect('home');
    }

    /** @test */
    public function teams_can_send_candidate_requests()
    {
        $candidate = factory(User::class)->create();

        $this->signIn($team = factory(Team::class)->create())
            ->post("/candidates/{$candidate->id}", ['body' => $body = 'Text'])
            ->assertRedirect(route('candidates.index'));

        $this->assertCount(1, $team->fresh()->candidates);
        $this->assertDatabaseHas('team_candidates', [
            'candidate_id' => $candidate->id,
            'team_id' => $team->id,
            'body' => $body,
        ]);
    }

    /** @test */
    public function teams_can_not_send_multiple_candidate_requests_to_one_candidate()
    {
        $team = factory(Team::class)->create();
        $team->sendCandidateRequest($candidate = factory(User::class)->create());

        $this->assertCount(1, $team->candidates);

        $this->signIn($team)
            ->post("/candidates/{$candidate->id}")
            ->assertSessionHasErrors(['candidate_dialog_exists' => 'You have already sent this candidate a dialog request.']);

        $this->assertCount(1, $team->fresh()->candidates);
    }

    /** @test */
    public function body_must_be_a_string_of_max_255_characters()
    {
        $candidate = factory(User::class)->create();

        $this->signIn($team = factory(Team::class)->create())
            ->post("/candidates/{$candidate->id}", [
                'body' => 1234,
            ])->assertSessionHasErrors('body');

        $this->post("/candidates/{$candidate->id}", [
            'body' => str_repeat('A', 256),
        ])->assertSessionHasErrors('body');

        $this->assertCount(0, $team->candidates);
    }
}
