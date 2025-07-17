@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nuevo Status</h1>
    <form action="{{ route('statuses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('statuses.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection 