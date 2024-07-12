@extends('layout.userBase')

@section('userContent')
    <div class="product-list-container">
        <div class="product-list">
            <h2>Lista de usuarios</h2>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($productos->isEmpty())
                <p>No hay productos disponibles.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sabor</th>
                            <th>Descripción</th>
                            <th>Material</th>
                            <th>Capacidad</th>
                            <th>Unidades</th>
                            <th>Tipo de Bebida</th>
                            <th>Marca</th>
                            <th>Existencias</th>
                            <th>Precio de Compra</th>
                            <th>Precio de Venta</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->sabor }}</td>
                                <td>{{ $producto->descripcion }}</td>
                                <td>{{ $producto->material }}</td>
                                <td>{{ $producto->capacidad }}</td>
                                <td>{{ $producto->unidades }}</td>
                                <td>{{ $producto->tipoBebida }}</td>
                                <td>{{ $producto->marca }}</td>
                                <td>{{ $producto->existencias }}</td>
                                <td>{{ $producto->precioCompra }}</td>
                                <td>{{ $producto->precioVenta }}</td>
                                <td class="img-cell">
                                    @if($producto->imagen)
                                        <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto" width="50">
                                    @endif
                                </td>
                                <td class="actions-cell">
                                    <a href="{{ route('product.edit', $producto->id) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-pen-nib"></i>
                                    </a>
                                    <form action="{{ route('product.destroy', $producto->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <i class="fa-solid fa-trash-can"></i>
                <i class="fa-solid fa-pen-nib"></i> --}}
            @endif
        </div>
    </div>
@endsection




