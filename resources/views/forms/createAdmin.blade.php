@extends('layout.userBase')

@section('userContent')
<div class="admin-panel">

    <div class="create-admin-form">

        <h1>Registrar un nuevo administrador</h1>

        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="lastname">Apellido:</label>
                <input type="text" name="lastname" id="lastname" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <button type="submit" class="submit-btn">Registrar</button>
        </form>
    </div>

</div>
@endsection
