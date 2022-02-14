<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, RecordsActivity;

    protected $guarded = [];

    protected $casts = [
        'owner_id' => 'integer',
        // Aplica cast na data e hora devido a nova serialização para Carbon dos timestamps
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

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
