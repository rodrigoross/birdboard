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
        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);
    }
}
