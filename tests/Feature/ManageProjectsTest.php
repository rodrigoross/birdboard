<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_create_projects()
    {
        $this->get('/projects/create')->assertRedirect('login');

        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function guest_may_not_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    /** @test */
    public function guest_may_not_view_a_single_project()
    {
        $project = Project::factory()->create();


        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function guest_may_not_edit_a_project()
    {
        $project = Project::factory()->create();

        $this->get($project->path() . "/edit")->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $this->followingRedirects()
            ->post('/projects', $attributes = Project::factory()->raw())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function tasks_can_be_included_as_part_of_new_projets_creations()
    {
        $this->signIn();

        $attributes = Project::factory()->raw();

        $attributes['tasks'] = [
            ['body' => 'Task 1'],
            ['body' => 'Task 2'],
        ];

        $this->post('/projects', $attributes);

        $this->assertCount(2, Project::first()->tasks);
    }

    /** @test */
    public function a_user_can_see_all_projects_they_have_been_invited_to_on_their_dashboard()
    {
        $project = tap(Project::factory()->create())->invite($this->signIn());

        $this->get(route('projects.index'))->assertSee($project->title);
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        $project = Project::factory()->create();

        $this->actingAs($project->owner)
            ->get($project->path() . "/edit")
            ->assertOk();

        $this->patch($project->path(), $attributes = [
            'title' => 'Changed',
            'description' => 'Changed',
            'notes' => 'Changed'
        ])->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_update_a_project_general_notes()
    {
        $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = ['notes' => 'Changed'])
            ->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_project_require_a_title()
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_require_a_description()
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $project = Project::factory()
            ->ownedBy($this->signIn())
            ->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_project_of_others()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_the_project_of_others()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->patch($project->path(), [])->assertStatus(403);
    }

    /** @test */
    public function unauthorized_users_cannot_delete_projects()
    {
        // $this->withoutExceptionHandling();
        $project = Project::factory()->create();

        $this->delete($project->path())
            ->assertRedirect('/login');

        $user = $this->signIn();

        $this->delete($project->path())->assertStatus(403);

        $project->invite($user);

        $this->actingAs($user)->delete($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_user_can_delete_a_project()
    {
        $project = Project::factory()->create();

        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }
}
