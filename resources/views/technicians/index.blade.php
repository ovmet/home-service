@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Técnicos</h1>
    <a href="{{ route('technicians.create') }}" class="btn btn-primary mb-3">Nuevo Técnico</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Notas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($technicians as $technician)
            <tr>
                <td>{{ $technician->id }}</td>
                <td>{{ $technician->name }}</td>
                <td>{{ $technician->phone }}</td>
                <td>{{ $technician->email }}</td>
                <td>{{ $technician->address }}</td>
                <td>{{ $technician->notes }}</td>
                <td>
                    <a href="{{ route('technicians.show', $technician) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('technicians.edit', $technician) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('technicians.destroy', $technician) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este técnico?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 