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
    public function creating_a_project_generate_activity()
    {
        $project = Project::factory()->create();

        $this->assertEquals(1, $project->activities->count());
        $this->assertEquals('created', $project->activities[0]->description);
    }

    /** @test */
    public function updating_a_project_generate_activity()
    {
        $project = Project::factory()->create();

        $project->update(['title' => 'Changed']);

        $this->assertEquals(2, $project->activities->count());
        $this->assertEquals('updated', $project->activities->last()->description);
    }
}
