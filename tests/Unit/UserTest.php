<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_projects()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    public function a_user_has_available_projects()
    {
        $john = $this->signIn();

        Project::factory()->ownedBy($john)->create();

        $this->assertCount(1, $john->availableProjects());

        $sally = User::factory()->create();
        $nick = User::factory()->create();

        $project = tap(Project::factory()->ownedBy($sally)->create())->invite($nick);

        $this->assertCount(1, $john->availableProjects());

        $project->invite($john);
        $this->assertCount(2, $john->availableProjects());
    }
}
