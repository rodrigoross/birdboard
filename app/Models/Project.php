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

    public function path()
    {
        return "/projects/{$this->id}";
    }

    /**
     * Pega o usuario proprietário do projeto
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
