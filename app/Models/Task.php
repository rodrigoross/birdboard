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
     * Aplica cast dos seguintes atributos
     *
     */
    protected $casts = [
        'completed' => 'boolean'
    ];

    /**
     * Completa atividade
     *
     * @return void
     */
    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');
    }

    /**
     * Marca a atividade como não completa
     *
     * @return void
     */
    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->recordActivity('uncompleted_task');
    }

    /**
     * Registra nova atividade da tarefa
     *
     * @param string $description
     * @return void
     */
    public function recordActivity($description)
    {
        $this->activities()->create([
            'project_id' => $this->project_id,
            'description' => $description
        ]);
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

    /**
     * Retorna atividades da tarefa.
     *
     * @return App\Models\Activity
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }
}
