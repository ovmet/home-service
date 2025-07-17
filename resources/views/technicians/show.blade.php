@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Técnico</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $technician->name }}</h5>
            <p class="card-text"><strong>Teléfono:</strong> {{ $technician->phone }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $technician->email }}</p>
            <p class="card-text"><strong>Dirección:</strong> {{ $technician->address }}</p>
            <p class="card-text"><strong>Notas:</strong> {{ $technician->notes }}</p>
            <a href="{{ route('technicians.edit', $technician) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('technicians.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
@endsection 