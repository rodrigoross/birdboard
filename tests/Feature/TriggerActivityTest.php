<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_project()
    {
        $project = Project::factory()->create();

        $this->assertEquals(1, $project->activities->count());
        $this->assertEquals('created', $project->activities[0]->description);
    }

    /** @test */
    public function updating_a_project()
    {
        $project = Project::factory()->create();

        $project->update(['title' => 'Changed']);

        $this->assertEquals(2, $project->activities->count());
        $this->assertEquals('updated', $project->activities->last()->description);
    }

    /** @test */
    public function creating_a_new_task()
    {
        $project = Project::factory()->create();

        $project->addTask('Some Task');

        $this->assertEquals(2, $project->activities->count());
        $this->assertEquals('created_task', $project->activities->last()->description);
    }

    /** @test */
    public function completing_a_task()
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

    /** @test */
    public function incompleting_a_task()
    {
        $project = Project::factory()->hasTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true
            ]);

        $this->assertEquals(3, $project->activities->count());

        $this->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => false
        ]);

        $project->refresh();

        $this->assertEquals(4, $project->activities->count());

        $this->assertEquals('uncompleted_task', $project->activities->last()->description);
    }

    /** @test */
    public function deleting_a_task()
    {
        $project = Project::factory()->hasTasks(1)->create();

        $project->tasks[0]->delete();

        $this->assertCount(3, $project->activities);
    }
}
