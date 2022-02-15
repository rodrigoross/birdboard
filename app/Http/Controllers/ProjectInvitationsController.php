<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    /**
     * @return void
     */
    public function store(Project $project)
    {
        $this->authorize('update', $project);

        request()->validate([
            'email' => 'required|exists:users,email'
        ], [
            'email.exists' => 'O usuário que está sendo convidado deve uma conta no Birdboard'
        ]);

        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

        return redirect($project->path());
    }
}
