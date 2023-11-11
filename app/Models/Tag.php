<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'etiquetas';

    protected $fillable = ['nombre', 'descripcion'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'etiqueta_tarea', 'etiqueta_id', 'tarea_id');
    }
}
