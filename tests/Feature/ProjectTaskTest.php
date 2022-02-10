<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $project = Project::factory()
            ->ownedBy($this->signIn())
            ->create();

        $this->post($project->path() . "/tasks", [
            'body' => 'Test task'
        ]);

        $this->get($project->path())->assertSee('Test task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = Project::factory()
            ->hasTasks(1)
            ->ownedBy($this->signIn())
            ->create();

        $this->patch($project->path() . "/tasks/{$project->tasks[0]->id}", [
            'body' => "changed",
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        // Cria projeto sobre outro usuario
        $project = Project::factory()->create();

        $this->post($project->path() . "/tasks", ['body' => "Test task"])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => "Test Task"]);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        // Cria projeto sobre outro usuario
        $project = Project::factory()
            ->hasTasks(1)
            ->create();

        $this->patch($project->path() . "/tasks/{$project->tasks[0]->id}", ['body' => "changed"])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => "changed"]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = Project::factory()
            ->ownedBy($this->signIn())
            ->create();

        $attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path() . "/tasks", $attributes)->assertSessionHasErrors('body');
    }
}
