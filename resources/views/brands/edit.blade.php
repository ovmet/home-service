@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Marca</h1>
    <form action="{{ route('brands.update', $brand) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $brand->name) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('brands.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection 