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
    public function non_owners_may_not_invite_users()
    {
        $user = User::factory()->create();

        $this->signIn($user);

        $this->post(Project::factory()->create()->path() . "/invite")
            ->assertForbidden();
    }

    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        $project = Project::factory()->create();

        $userToInvite = User::factory()->create();

        $this->actingAs($project->owner)
            ->post($project->path() . "/invite", [
                'email' => $userToInvite->email
            ])
            ->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($userToInvite));
    }

    /** @test */
    public function the_invited_email_must_be_associated_with_valid_birdboard_account()
    {
        $project = Project::factory()->create();

        $this->actingAs($project->owner)
            ->post("{$project->path()}/invite", [
                'email' => 'notauser@example.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'O usuário que está sendo convidado deve uma conta no Birdboard'
            ]);
    }

    /** @test */
    public function invited_users_may_update_project_details()
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
