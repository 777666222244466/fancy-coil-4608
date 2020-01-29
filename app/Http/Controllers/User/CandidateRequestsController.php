<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Team;

class CandidateRequestsController extends Controller
{
    public function index()
    {
        $teamRequests = auth()->user()->teamRequests;

        return view('candidate.requests.index', compact('teamRequests'));
    }

    public function accept(Team $team, $notificationId)
    {
        // All of the below might be better off wrapped in a
        // helper method, e.g ->acceptTeamRequest()

        $notification = auth()->user()->unreadNotifications->where('id', $notificationId);
        $notification->markAsRead();

        auth()->user()->teamRequests()->updateExistingPivot($team->id, ['accepted_at' => now()]);

        return redirect()->route('candidate.requests.index')->with('status', 'Candidate request accepted.');
    }
}
