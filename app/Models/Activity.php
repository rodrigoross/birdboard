<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Retorna quem disparou a atividade
     *
     * @return App\Models\Task|App\Models\Project
     */
    public function subject()
    {
        return $this->morphTo();
    }
}
