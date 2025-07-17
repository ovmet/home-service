@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Status</h1>
    <a href="{{ route('statuses.create') }}" class="btn btn-primary mb-3">Nuevo Status</a>
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
            @foreach($statuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>
                    <a href="{{ route('statuses.edit', $status) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('statuses.destroy', $status) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este status?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 