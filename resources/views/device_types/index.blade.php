@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Tipos de Dispositivo</h1>
        <a href="{{ route('device-types.create') }}" class="btn btn-primary">Nuevo Tipo</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($deviceTypes->isEmpty())
        <div class="alert alert-info">No hay tipos de dispositivo registrados.</div>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deviceTypes as $type)
            <tr>
                <td>{{ $type->id }}</td>
                <td>{{ $type->name }}</td>
                <td>
                    <a href="{{ route('device-types.show', $type) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('device-types.edit', $type) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('device-types.destroy', $type) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este tipo?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection 