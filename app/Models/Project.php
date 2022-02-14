<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $notes
 * @property int $owner_id
 * @property mixed|null $created_at
 * @property mixed|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Database\Factories\ProjectFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    protected static $recordableEvents = ['created', 'updated'];

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
