<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'owner_id' => 'integer'
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
     * @return User
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
