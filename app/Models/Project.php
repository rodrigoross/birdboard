<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'owner_id' => 'integer',
        // Aplica cast na data e hora devido a nova serialização para Carbon dos timestamps
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    public $old = [];

    /**
     * Retorna a url base do projeto
     *
     * @return string
     */
    public function path()
    {
        return "/projects/{$this->id}";
    }

    /**
     * Adiciona uma nova task no projeto
     *
     * @return void
     */
    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    /**
     * Registra atividade nova atividades do projeto
     *
     * @param string $description
     * @return void
     */
    public function recordActivity($description)
    {
        $this->activities()->create([
            'description' => $description,
            'changes' => $this->activityChanges($description)
        ]);
    }

    /**
     * Retorna alterações do projeto
     *
     * @return void
     */
    protected function activityChanges($description)
    {
        if ($description !== 'updated') return;

        return [
            'before' => Arr::except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
            'after' => Arr::except($this->getChanges(), 'updated_at')
        ];
    }

    /**
     * Pega o usuario proprietário do projeto
     *
     * @return User
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Pega o usuario proprietário do projeto
     *
     * @return User
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Retorna atividades do projeto.
     *
     * @return App\Models\Activity
     */
    public function activities()
    {
        return $this->hasMany(Activity::class)->latest();
    }
}
