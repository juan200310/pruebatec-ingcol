<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = ['nombre', 'descripcion', 'fecha_creacion', 'fecha_vencimiento', 'usuario_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'etiqueta_tarea', 'tarea_id', 'etiqueta_id');
    }
}

