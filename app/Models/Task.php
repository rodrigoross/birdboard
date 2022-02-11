<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Lista de instancias que devem ser tocadas/atualizadas quando uma tarefa
     * for alterada
     */
    protected $touches = [
        'project'
    ];

    /**
     * @override boot() method do model
     *
     * Adiciona observavel para quando uma nova task é criada e executada.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            $task->project->recordActivity('created_task');
        });

        static::updated(function ($task) {
            if (!$task->completed) return;

            $task->project->recordActivity('completed_task');
        });
    }
    /**
     * Helper path function
     */
    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    /**
     * Uma tarefa pertence a somente um projeto
     *
     * @return App\Models\Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
