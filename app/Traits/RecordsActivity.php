<?php

namespace App\Traits;

use App\Models\Activity;
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
        static::updating(function ($model) {
            $model->oldAttributes = $model->getOriginal();
        });
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
