<?php

namespace Tests\Unit;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_candidates()
    {
        $team = factory(Team::class)->create();

        $this->assertInstanceOf(Collection::class, $team->candidates);
    }

    /** @test */
    public function it_can_send_candidate_requests()
    {
        $team = factory(Team::class)->create();
        $team->sendCandidateRequest($candidate = factory(User::class)->create(), ['body' => 'text']);

        $this->assertCount(1, $team->candidates);
        $this->assertInstanceOf('App\Models\User', $team->candidates[0]);
        $this->assertDatabaseHas('team_candidates', [
            'candidate_id' => $candidate->id,
            'team_id' => $team->id,
            'body' => 'text',
        ]);
    }
}
