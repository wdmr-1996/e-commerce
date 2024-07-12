@extends('layout.userBase')

@section('userContent')
<div class="admin-panel">
    <div class="edit-admin-form">
        <h1>Editar Usuario</h1>

        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="lastname">Apellido:</label>
                <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>
            <button type="submit" class="submit-btn">Guardar Cambios</button>
        </form>
    </div>
</div>
@endsection
