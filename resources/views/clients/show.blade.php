@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Cliente</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $client->name }}</h5>
            <p class="card-text"><strong>Teléfono:</strong> {{ $client->phone }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $client->email }}</p>
            <p class="card-text"><strong>Dirección:</strong> {{ $client->address }}</p>
            <p class="card-text"><strong>Notas:</strong> {{ $client->notes }}</p>
            <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
@endsection 