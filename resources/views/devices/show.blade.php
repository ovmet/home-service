@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Equipo</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $device->model }}</h5>
            <p class="card-text"><strong>Cliente:</strong> {{ $device->client->name ?? '-' }}</p>
            <p class="card-text"><strong>Marca:</strong> {{ $device->brand->name ?? '-' }}</p>
            <p class="card-text"><strong>Tipo:</strong> {{ $device->deviceType->name ?? '-' }}</p>
            <p class="card-text"><strong>Número de serie:</strong> {{ $device->serial_number }}</p>
            <a href="{{ route('devices.edit', $device) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('devices.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
@endsection 