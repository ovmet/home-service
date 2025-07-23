@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Detalle de la Orden de Reparación #{{ $repairOrder->id }}</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Equipo: {{ $repairOrder->device->model ?? '-' }}</h5>
            <p class="card-text"><strong>Técnico:</strong> {{ $repairOrder->technician->name ?? '-' }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $repairOrder->status->name ?? '-' }}</p>
            <p class="card-text"><strong>Descripción:</strong> {{ $repairOrder->description }}</p>
            <p class="card-text"><strong>Costo:</strong> {{ $repairOrder->cost }}</p>
            <p class="card-text"><strong>Fecha de entrada:</strong> {{ $repairOrder->entry_date }}</p>
            <p class="card-text"><strong>Fecha de salida:</strong> {{ $repairOrder->exit_date }}</p>
            <p class="card-text"><strong>Notas:</strong> {{ $repairOrder->notes }}</p>
            <p class="card-text"><strong>Ubicación del servicio:</strong> {{ $repairOrder->service_location == 'foraneo' ? 'Foráneo' : 'En taller' }}</p>
            <a href="{{ route('repair-orders.edit', $repairOrder) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('repair-orders.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
@endsection 