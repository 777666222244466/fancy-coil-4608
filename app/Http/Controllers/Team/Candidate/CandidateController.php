<?php

namespace App\Http\Controllers\Team\Candidate;

use App\Http\Controllers\Controller;
use App\Models\User;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = User::latest()->limit(10)->get();

        return view('candidates.index', compact('candidates'));
    }

    public function store(User $candidate)
    {
        // yuck.
        $team = auth()->user();

        if ($team->candidates->contains($candidate)) {
            return back()->withErrors([
                'candidate_dialog_exists' => 'You have already sent this candidate a dialog request.',
            ])->withInput();
        }

        $team->sendCandidateRequest(
            $candidate,
            request()->validate([
                'body' => 'string|max:255|nullable',
            ])
        );

        return redirect()->route('candidates.index');
    }
}
