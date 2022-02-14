<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
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

        tap($project->activities->last(), function ($activity) {
            $this->assertEquals('created', $activity->description);

            $this->assertNull($activity->changes);
        });
    }

    /** @test */
    public function updating_a_project()
    {
        $project = Project::factory()->create();
        $originalTitle = $project->title;

        $project->update(['title' => 'Changed']);

        $this->assertEquals(2, $project->activities->count());

        tap($project->activities->last(), function ($activity) use ($originalTitle) {
            $this->assertEquals('updated', $activity->description);

            $expected = [
                'before' => ['title' => $originalTitle],
                'after' =>  ['title' => 'Changed']
            ];
            $this->assertEquals($expected, $activity->changes);
        });
    }

    /** @test */
    public function creating_a_new_task()
    {
        $project = Project::factory()->create();

        $project->addTask('Some Task');

        $this->assertEquals(2, $project->activities->count());

        /**
         * Utiliza tap para poder acessar a variavel diretamente ao inves de:
         *  - $project->activities->last()->description
         */
        tap($project->activities->last(), function ($activity) {
            $this->assertEquals('created_task', $activity->description);
            // Testa polimorfismo para acessar task pela atividade criada
            $this->assertInstanceOf(Task::class, $activity->subject);
            $this->AssertEquals('Some Task', $activity->subject->body);
        });
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

        tap($project->activities->last(), function ($activity) {
            $this->assertEquals('completed_task', $activity->description);
            // Testa polimorfismo para acessar task pela atividade criada
            $this->assertInstanceOf(Task::class, $activity->subject);
        });
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

        tap($project->activities->last(), function ($activity) {
            $this->assertEquals('uncompleted_task', $activity->description);
            // Testa polimorfismo para acessar task pela atividade criada
            $this->assertInstanceOf(Task::class, $activity->subject);
        });
    }

    /** @test */
    public function deleting_a_task()
    {
        $project = Project::factory()->hasTasks(1)->create();

        $project->tasks[0]->delete();

        $this->assertCount(3, $project->activities);
    }
}
