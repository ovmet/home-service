@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Equipos</h1>
    <a href="{{ route('devices.create') }}" class="btn btn-primary mb-3">Nuevo Equipo</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $device)
            <tr>
                <td>{{ $device->id }}</td>
                <td>{{ $device->client->name ?? '-' }}</td>
                <td>{{ $device->brand->name ?? '-' }}</td>
                <td>{{ $device->deviceType->name ?? '-' }}</td>
                <td>{{ $device->model }}</td>
                <td>{{ $device->serial_number }}</td>
                <td>
                    <a href="{{ route('devices.show', $device) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('devices.edit', $device) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('devices.destroy', $device) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este equipo?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 