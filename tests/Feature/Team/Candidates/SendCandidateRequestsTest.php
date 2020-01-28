<?php

namespace Tests\Feature\Team\Candidates;

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
        $this->markTestSkipped();
    }

    /** @test */
    public function body_is_required()
    {
        $this->markTestSkipped();
    }
}
