<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, RecordsActivity;

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

    protected static $recordableEvents = ['created', 'deleted'];

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
