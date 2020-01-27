<?php

namespace Tests\Support\Traits;

use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

trait UseAuth
{
    protected function signIn(Authenticatable $user = null): self
    {
        return $this->actingAs($user ?: factory(User::class)->create());
    }
}
