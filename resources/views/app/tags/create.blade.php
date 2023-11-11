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


        <h1>Crear Etiqueta</h1>
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Etiqueta</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Crear Etiqueta</button>
        </form>
    </div>
@endsection
