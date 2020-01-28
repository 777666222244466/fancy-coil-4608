<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Team extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function candidates()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'team_candidates',
            'team_id',
            'candidate_id'
        )->withTimestamps();
    }

    public function sendCandidateRequest(User $candidate, array $attributes = []): void
    {
        $this->candidates()->attach($candidate, $attributes);
    }
}
