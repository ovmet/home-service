@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Tipo de Equipo</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $device_type->name }}</h5>
            <a href="{{ route('device-types.edit', $device_type) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('device-types.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
@endsection 