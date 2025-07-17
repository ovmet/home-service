@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Marcas de Equipos</h1>
    <a href="{{ route('brands.create') }}" class="btn btn-primary mb-3">Nueva Marca</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
            <tr>
                <td>{{ $brand->id }}</td>
                <td>{{ $brand->name }}</td>
                <td>
                    <a href="{{ route('brands.show', $brand) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('brands.edit', $brand) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('brands.destroy', $brand) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta marca?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 