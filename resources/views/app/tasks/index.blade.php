@extends('layouts.app')

@section('content')
    <div class="container">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        <h1 class="mb-4">Listado de Tareas</h1>

        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-4">Crear Nueva Tarea</a>


        <hr>

        <form action="{{ route('tasks.index') }}" method="GET">
            <div class="mb-3">
                <label for="user_filter" class="form-label">Seleccionar Usuario:</label>
                <select name="user_filter" id="user_filter" class="form-control">
                    <option value="">Todos los usuarios</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary my-4">Filtrar</button>
            </div>
        </form>

        <hr>

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha de creación</th>
                    <th>Etiquetas</th>
                    <th>Creada por</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->nombre }}</td>
                        <td>{{ $task->descripcion }}</td>
                        <td>{{ $task->fecha_creacion }}</td>

                        @if(isset($task->tags))
                            <td>
                                @foreach($task->tags as $tag)
                                <span class="badge bg-primary">{{ $tag->nombre }}</span><br>
                                @endforeach
                            </td>
                        @endif

                        <td>{{ $task->user->name }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning mb-2">Editar</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
