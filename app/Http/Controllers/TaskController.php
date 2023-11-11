<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        $tasks = Task::with(['user', 'tags']);

        if ($request->filled('user_filter')) {
            $tasks->where('usuario_id', $request->input('user_filter'));
        }
    
        $tasks = $tasks->get();
    
        return view('app.tasks.index', compact('tasks', 'users'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('app.tasks.create', compact('tags'));
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

        $task->tags()->sync($request->input('etiquetas'));

        return redirect()->route('tasks.index')->with('success', 'Tarea creada correctamente.');
    }

    public function edit($id)
    {
        $task = Task::find($id);
        $tags = Tag::all();

        Gate::authorize('update', $task);
        
        return view('app.tasks.edit', compact('task', 'tags'));
    }

    public function update(TaskRequest $request, $id)
    {
        $request->validated();

        $task = Task::find($id);

        Gate::authorize('update', $task);

        $task->nombre = $request->input('nombre');
        $task->descripcion = $request->input('descripcion');
        $task->fecha_vencimiento = $request->input('fecha_vencimiento');
        $task->save();

        $task->tags()->sync($request->input('etiquetas'));

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        Gate::authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente.');
    }
}
