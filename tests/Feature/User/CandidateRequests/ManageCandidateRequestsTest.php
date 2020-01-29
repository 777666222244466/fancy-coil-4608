<?php

namespace Tests\Feature\User\CandidateRequests;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageCandidateRequestsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_candidate_requests()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function unauthorized_users_cannot_manage_candidate_requests()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function teams_cannot_manage_candidate_requests()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function candidates_can_view_all_candidate_requests()
    {
        $teamA = factory(Team::class)->create();
        $teamB = factory(Team::class)->create();
        $candidate = factory(User::class)->create();

        $teamA->sendCandidateRequest($candidate);
        $teamB->sendCandidateRequest($candidate);

        $response = $this->signIn($candidate)
                        ->get('/candidate/requests')
                        ->assertStatus(200);

        $this->assertCount(2, $response->data('teamRequests'));
    }

    /** @test */
    public function candidates_can_accept_a_candidate_request()
    {
        $team = factory(Team::class)->create();
        $candidate = factory(User::class)->create();

        $team->sendCandidateRequest($candidate);

        // Accept the requests...
        $this->signIn($candidate)
            ->post("/candidate/requests/{$team->id}/{$candidate->notifications[0]->id}/accept")
            ->assertRedirect('/candidate/requests')
            ->assertSessionHas(['status' => 'Candidate request accepted.']);

        // Make sure the accepted_at has been updated...
        $this->assertDatabaseHas('team_candidates', [
            'team_id' => $team->id,
            'candidate_id' => $candidate->id,
            'accepted_at' => now(),
        ]);

        // Assert that the notification has been marked as read...
        $this->assertCount(0, $candidate->fresh()->unreadNotifications);
    }

    /** @test */
    public function candidates_can_deny_a_candidate_request()
    {
        $this->markTestSkipped();
    }
}
