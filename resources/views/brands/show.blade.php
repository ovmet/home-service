@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de la Marca</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $brand->name }}</h5>
            <a href="{{ route('brands.edit', $brand) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
@endsection 