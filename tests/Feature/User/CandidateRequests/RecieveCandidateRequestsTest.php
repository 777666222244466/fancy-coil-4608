<?php

namespace Tests\Feature\User\CandidateRequests;

use App\Models\Team;
use App\Models\User;
use App\Notifications\CandidateRequestSent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RecieveCandidateRequestsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function recieving_a_candidate_request_triggers_a_notification()
    {
        Notification::fake();

        $team = factory(Team::class)->create();
        $candidate = factory(User::class)->create();

        $team->sendCandidateRequest($candidate);

        Notification::assertSentTo(
            $candidate,
            CandidateRequestSent::class,
            function ($notification, $channels) use ($team) {
                return $notification->team->id === $team->id;
            }
        );
    }
}
