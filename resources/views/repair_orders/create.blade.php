@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Orden de Reparación</h1>
    <form method="GET" action="{{ route('repair-orders.create') }}" class="mb-4">
        <div class="mb-3">
            <label for="client_id" class="form-label">Cliente</label>
            <select name="client_id" class="form-control" onchange="this.form.submit()" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ (isset($clientId) && $clientId == $client->id) ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
    </form>
    @if(isset($clientId) && $clientId && $devices->count())
    <form action="{{ route('repair-orders.store') }}" method="POST">
        @csrf
        <input type="hidden" name="client_id" value="{{ $clientId }}">
        <div class="mb-3">
            <label for="device_id" class="form-label">Equipo</label>
            <select name="device_id" class="form-control" required>
                <option value="">Seleccione un equipo</option>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}">{{ $device->model }} ({{ $device->serial_number }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="technician_id" class="form-label">Técnico</label>
            <select name="technician_id" class="form-control">
                <option value="">Sin asignar</option>
                @foreach($technicians as $tech)
                    <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status_id" class="form-label">Status</label>
            <select name="status_id" class="form-control" required>
                <option value="">Seleccione un status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="cost" class="form-label">Costo</label>
            <input type="number" step="0.01" name="cost" class="form-control" value="{{ old('cost') }}">
        </div>
        <div class="mb-3">
            <label for="entry_date" class="form-label">Fecha de entrada</label>
            <input type="date" name="entry_date" class="form-control" value="{{ old('entry_date') }}">
        </div>
        <div class="mb-3">
            <label for="exit_date" class="form-label">Fecha de salida</label>
            <input type="date" name="exit_date" class="form-control" value="{{ old('exit_date') }}">
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notas</label>
            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('repair-orders.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    @elseif(isset($clientId) && $clientId && !$devices->count())
        <div class="alert alert-warning">Este cliente no tiene equipos registrados. <a href="{{ route('devices.create') }}">Registrar equipo</a></div>
    @endif
</div>
@endsection 