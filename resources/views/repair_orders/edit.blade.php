@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Orden de Reparación</h1>
    <form action="{{ route('repair-orders.update', $repairOrder) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="device_id" class="form-label">Equipo</label>
            <select name="device_id" class="form-control" required>
                <option value="">Seleccione un equipo</option>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}" {{ old('device_id', $repairOrder->device_id) == $device->id ? 'selected' : '' }}>{{ $device->model }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="technician_id" class="form-label">Técnico</label>
            <select name="technician_id" class="form-control">
                <option value="">Sin asignar</option>
                @foreach($technicians as $tech)
                    <option value="{{ $tech->id }}" {{ old('technician_id', $repairOrder->technician_id) == $tech->id ? 'selected' : '' }}>{{ $tech->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status_id" class="form-label">Status</label>
            <select name="status_id" class="form-control" required>
                <option value="">Seleccione un status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ old('status_id', $repairOrder->status_id) == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control">{{ old('description', $repairOrder->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="cost" class="form-label">Costo</label>
            <input type="number" step="0.01" name="cost" class="form-control" value="{{ old('cost', $repairOrder->cost) }}">
        </div>
        <div class="mb-3">
            <label for="entry_date" class="form-label">Fecha de entrada</label>
            <input type="date" name="entry_date" class="form-control" value="{{ old('entry_date', $repairOrder->entry_date) }}">
        </div>
        <div class="mb-3">
            <label for="exit_date" class="form-label">Fecha de salida</label>
            <input type="date" name="exit_date" class="form-control" value="{{ old('exit_date', $repairOrder->exit_date) }}">
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notas</label>
            <textarea name="notes" class="form-control">{{ old('notes', $repairOrder->notes) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('repair-orders.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection 