<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function store(TaskRequest $request)
    {
        $request->validated();

        $task = new Task();
        $task->nombre = $request->input('nombre');
        $task->descripcion = $request->input('descripcion');
        $task->fecha_creacion = now();
        $task->fecha_vencimiento = $request->input('fecha_vencimiento');
        $task->usuario_id = Auth::id();
        $task->save();

        return response()->json($task, 200);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);

        Gate::authorize('update', $task);

        $task->nombre = $request->input('nombre');
        $task->descripcion = $request->input('descripcion');
        $task->fecha_vencimiento = $request->input('fecha_vencimiento');
        $task->save();

        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        Gate::authorize('delete', $task);

        $task->delete();
        
        return response()->json('eliminacion exitosa', 200);
    }
}
