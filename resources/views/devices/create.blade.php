@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nuevo Equipo</h1>
    <form action="{{ route('devices.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="client_id" class="form-label">Cliente</label>
            <select name="client_id" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Marca</label>
            <select name="brand_id" class="form-control" required>
                <option value="">Seleccione una marca</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="device_type_id" class="form-label">Tipo de equipo</label>
            <select name="device_type_id" class="form-control" required>
                <option value="">Seleccione un tipo</option>
                @foreach($deviceTypes as $type)
                    <option value="{{ $type->id }}" {{ old('device_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Modelo</label>
            <input type="text" name="model" class="form-control" value="{{ old('model') }}">
        </div>
        <div class="mb-3">
            <label for="serial_number" class="form-label">Número de serie</label>
            <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number') }}">
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('devices.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection 