@extends('layout.userBase')

@section('userContent')
<div class="user-panel">
    <h1>Perfil de Usuario</h1>
    <h3>Bienvenido, {{ Auth::user()->name }}</h3>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">Cerrar Sesión</button>
    </form>
    <form action="{{ route('product.create') }}" method="GET">
        @csrf
        <button type="submit" class="logout-btn">Ingresar un nuevo producto</button>
    </form>
</div>
@endsection
