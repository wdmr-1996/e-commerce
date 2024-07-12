@extends('layout.userBase')

@section('userContent')
<div class="user-panel">
    <h2>Bienvenido, {{ Auth::user()->name }}</h2>
    <div class="cards">
        <a href="{{ route('product.create') }}">
            <div class="card card1">
                <h3>Agregar productos</h3>
                <p>30</p>
            </div>
        </a>
        <a href="{{ route('product.list') }}">
            <div class="card card2">
                <h3>Inventario de productos</h3>
                <p>50</p>
            </div>
        </a>

        <a href="{{ route('admin.create') }}">
            <div class="card card3">
                <h3>Gestion de usuarios</h3>
                <p>70</p>
            </div>
        </a>

        <a href="{{ route('user.list') }}">
            <div class="card card4">
                <h3>Regstrar un administrador</h3>
                <p>20</p>
            </div>
        </a>

    {{-- <h1>Perfil del administrador</h1>
    <h3>Bienvenido, {{ Auth::user()->name }}</h3>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">Cerrar Sesión</button>
    </form>
    <form action="{{ route('product.create') }}" method="GET">
        @csrf
        <button type="submit" class="logout-btn">Ingresar un nuevo producto</button>
    </form> --}}
</div>
@endsection
