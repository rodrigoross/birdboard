<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    /**
     * Cria uma nova tarefa dentro do projeto especificado
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project)
    {
        request()->validate([
            'body' => 'required'
        ]);

        $project->addTask(request('body'));

        return redirect($project->path());
    }
}
