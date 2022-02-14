<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_invite_a_user()
    {
        $project = Project::factory()->create();

        $project->invite($newUser = User::factory()->create());

        $this->signIn($newUser);
        // Uma outra forma de mandar a rota para teste
        $this->post(route('tasks.store', $project), $task = [
            'body' => 'Foo bar'
        ]);

        $this->assertDatabaseHas('tasks', $task);
    }
}
