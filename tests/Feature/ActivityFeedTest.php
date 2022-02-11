<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_project_records_activity()
    {
        $project = Project::factory()->create();

        $this->assertEquals(1, $project->activities->count());
        $this->assertEquals('created', $project->activities[0]->description);
    }

    /** @test */
    public function updating_a_project_records_activity()
    {
        $project = Project::factory()->create();

        $project->update(['title' => 'Changed']);

        $this->assertEquals(2, $project->activities->count());
        $this->assertEquals('updated', $project->activities->last()->description);
    }

    /** @test */
    public function creating_a_new_task_records_project_activity()
    {
        $project = Project::factory()->create();

        $project->addTask('Some Task');

        $this->assertEquals(2, $project->activities->count());
        $this->assertEquals('created_task', $project->activities->last()->description);
    }

    /** @test */
    public function completing_a_task_records_project_activity()
    {
        $project = Project::factory()->hasTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true
            ]);

        $this->assertEquals(3, $project->activities->count());
        $this->assertEquals('completed_task', $project->activities->last()->description);
    }
}
