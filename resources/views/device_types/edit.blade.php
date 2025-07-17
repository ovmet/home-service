@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Tipo de Equipo</h1>
    <form action="{{ route('device-types.update', $device_type) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $device_type->name) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('device-types.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection 