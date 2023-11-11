@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1>Crear Nueva Tarea</h1>
        <form action="{{ route('tasks.store') }}" method="POST" class="task-form">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento">
            </div>

            @if(isset($tags))
            <div class="mb-3">
                <label>Etiquetas</label>
                @foreach($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="etiquetas[]" value="{{ $tag->id }}" id="etiqueta_{{ $tag->id }}">
                        <label class="form-check-label" for="etiqueta_{{ $tag->id }}">
                            {{ $tag->nombre }}
                        </label>
                    </div>
                @endforeach
            </div>
            @endif

            <button type="submit" class="btn btn-primary">Crear Tarea</button>
        </form>
    </div>
@endsection
