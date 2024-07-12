@extends('layout.userBase')

@section('userContent')
    <div class="product-form-container">
        <div class="product-form">
            <h2>Editar Producto</h2>
            <form action="{{ route('product.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="item">
                    <label for="sabor">Sabor</label>
                    <input type="text" name="sabor" id="sabor" class="form-control" value="{{ $producto->sabor }}">
                </div>
                @error('sabor')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $producto->descripcion }}" required>
                </div>
                @error('descripcion')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="material">Material</label>
                    <select name="material" id="material" class="form-control" required>
                        <option value="" disabled>Selecciona una opción</option>
                        <option value="PET" {{ $producto->material == 'PET' ? 'selected' : '' }}>PET</option>
                        <option value="Tetrapack" {{ $producto->material == 'Tetrapack' ? 'selected' : '' }}>Tetrapack</option>
                        <option value="Vidrio" {{ $producto->material == 'Vidrio' ? 'selected' : '' }}>Vidrio</option>
                        <option value="Lata" {{ $producto->material == 'Lata' ? 'selected' : '' }}>Lata</option>
                    </select>
                </div>
                @error('material')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="capacidad">Capacidad</label>
                    <input type="number" step="0.01" name="capacidad" id="capacidad" class="form-control" value="{{ $producto->capacidad }}" required>
                </div>
                @error('capacidad')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="unidades">Unidades</label>
                    <select name="unidades" id="unidades" class="form-control" required>
                        <option value="" disabled>Selecciona una opción</option>
                        <option value="1" {{ $producto->unidades == 1 ? 'selected' : '' }}>1 und</option>
                        <option value="2" {{ $producto->unidades == 2 ? 'selected' : '' }}>2 und</option>
                        <option value="3" {{ $producto->unidades == 3 ? 'selected' : '' }}>3 und</option>
                        <option value="6" {{ $producto->unidades == 6 ? 'selected' : '' }}>6 und</option>
                        <option value="12" {{ $producto->unidades == 12 ? 'selected' : '' }}>12 und</option>
                    </select>
                </div>
                @error('unidades')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="tipoBebida">Tipo de Bebida</label>
                    <select name="tipoBebida" id="tipoBebida" class="form-control" required>
                        <option value="" disabled>Selecciona una opción</option>
                        <option value="Agua" {{ $producto->tipoBebida == 'Agua' ? 'selected' : '' }}>Agua</option>
                        <option value="Hidratante" {{ $producto->tipoBebida == 'Hidratante' ? 'selected' : '' }}>Hidratante</option>
                        <option value="Soda" {{ $producto->tipoBebida == 'Soda' ? 'selected' : '' }}>Soda</option>
                        <option value="Mezclador" {{ $producto->tipoBebida == 'Mezclador' ? 'selected' : '' }}>Mezclador</option>
                        <option value="Cerveza" {{ $producto->tipoBebida == 'Cerveza' ? 'selected' : '' }}>Cerveza</option>
                        <option value="Licor" {{ $producto->tipoBebida == 'Licor' ? 'selected' : '' }}>Licor</option>
                        <option value="Gaseosa" {{ $producto->tipoBebida == 'Gaseosa' ? 'selected' : '' }}>Gaseosa</option>
                        <option value="Refresco" {{ $producto->tipoBebida == 'Refresco' ? 'selected' : '' }}>Refresco</option>
                        <option value="Jugo" {{ $producto->tipoBebida == 'Jugo' ? 'selected' : '' }}>Jugo</option>
                        <option value="Energizante" {{ $producto->tipoBebida == 'Energizante' ? 'selected' : '' }}>Energizante</option>
                        <option value="Té e Infusiones" {{ $producto->tipoBebida == 'Té e Infusiones' ? 'selected' : '' }}>Té e Infusiones</option>
                    </select>
                </div>
                @error('tipoBebida')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca" id="marca" class="form-control" value="{{ $producto->marca }}" required>
                </div>
                @error('marca')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="existencias">Existencias</label>
                    <input type="number" name="existencias" id="existencias" class="form-control" value="{{ $producto->existencias }}" required>
                </div>
                @error('existencias')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="precioCompra">Precio de Compra</label>
                    <input type="number" step="0.01" name="precioCompra" id="precioCompra" class="form-control" value="{{ $producto->precioCompra }}">
                </div>
                @error('precioCompra')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="precioVenta">Precio de Venta</label>
                    <input type="number" step="0.01" name="precioVenta" id="precioVenta" class="form-control" value="{{ $producto->precioVenta }}" required>
                </div>
                @error('precioVenta')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item item-upload">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control">
                </div>
                @if($producto->imagen)
                    <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto" width="100">
                @endif
                @error('imagen')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
@endsection

