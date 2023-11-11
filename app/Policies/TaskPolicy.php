<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determinar si el usuario puede Actualizar una tarea
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->usuario_id;
    }

    /**
     * Determinar si el usuario puede eliminar una tarea
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->usuario_id;
    }
}
