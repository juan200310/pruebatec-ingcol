<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Clase TaskController que contiene los metodos para interactuar con la API de creacion, actualizacion y eliminacion de tareas
 *
 * @author  Juan Lopez
 */
class TaskController extends Controller
{
    /**
     * Funcion que retorna el listado de todas las tareas creadas
     *  
     * @author Juan Lopez
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Funcion que se encarga de realizar la creacion de una tarea
     *  
     * @param TaskRequest $request
     * 
     * @author Juan Lopez
     */
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

    /**
     * Funcion que se encarga de realizar la actualizacion de una tarea
     *  
     * @param TaskRequest $request
     * 
     * @author Juan Lopez
     */
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

    /**
     * Funcion que se encarga de realizar el borrado de una tarea
     *  
     * @param int $id
     * 
     * @author Juan Lopez
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        Gate::authorize('delete', $task);

        $task->delete();
        
        return response()->json('eliminacion exitosa', 200);
    }
}
