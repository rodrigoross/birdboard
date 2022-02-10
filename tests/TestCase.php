<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Helper function que cria usuario ou seta usuario como usuário logado
     *
     * @param App\Models\User $user|null
     * @return App\Models\User $user
     */
    protected function signIn($user = null)
    {
        $user = $user ?: User::factory()->create();

        $this->actingAs($user);

        return $user;
    }
}
