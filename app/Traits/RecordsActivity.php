<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

trait RecordsActivity
{
    /**
     * Valor dos registros antes da alteração
     *
     */
    public $oldAttributes = [];

    /**
     * Boot do traço para regitrar novas atividades ao Model que utiliza.
     *
     */
    public static function bootRecordsActivity()
    {
        // inicializa eventos para gravar nova atividade
        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function ($model) {
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }
    }

    /**
     * Define eventos utilizado para gravar atividades.
     *
     */
    protected static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }
        return ['created', 'updated', 'deleted'];
    }

    /**
     * Retorna a descrição da atividade
     *
     * @param string $event
     * @return string $description
     */
    protected function activityDescription($description)
    {
        return "{$description}_" . Str::lower(class_basename($this));
    }

    /**
     * Registra uma nova atividade
     *
     * @return void
     */
    public function recordActivity($description)
    {
        $this->activities()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
        ]);
    }

    /**
     * Retorna alterações do modelo
     *
     * @return void
     */
    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after' => Arr::except($this->getChanges(), 'updated_at')
            ];
        }
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
