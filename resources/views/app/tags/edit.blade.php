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

        <h1>Editar Etiqueta</h1>
        <form action="{{ route('tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Etiqueta</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $tag->nombre }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Etiqueta</button>
        </form>
    </div>
@endsection
