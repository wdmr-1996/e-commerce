@extends('layout.userBase')

@section('userContent')
    <div class="product-form-container">
        <div class="product-form">
            <h2>Crear Producto</h2>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                {{-- <div class="item">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                @error('nombre')
                    <div class="error">{{ $message }}</div>
                @enderror --}}

                <div class="item">
                    <label for="tipoBebida">Tipo de Bebida</label>
                    <select name="tipoBebida" id="tipoBebida" class="form-control" required>
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="agua">Agua</option>
                        <option value="hidratante">Hidratante</option>
                        <option value="soda">Soda</option>
                        <option value="mezclador">Mezclador</option>
                        <option value="cerveza">Cerveza</option>
                        <option value="licor">Licor</option>
                        <option value="gaseosa">Gaseosa</option>
                        <option value="refresco">Refresco</option>
                        <option value="jugo">Jugo</option>
                        <option value="energizante">Energizante</option>
                        <option value="teEInfusiones">Té e Infusiones</option>
                    </select>
                </div>
                @error('tipoBebida')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca" id="marca" class="form-control" required>
                </div>
                @error('marca')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="sabor">Sabor</label>
                    <input type="text" name="sabor" id="sabor" class="form-control">
                </div>
                @error('sabor')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="material">Material</label>
                    <select name="material" id="material" class="form-control" required>
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="PET">PET</option>
                        <option value="Tetrapack">Tetrapack</option>
                        <option value="Vidrio">Vidrio</option>
                        <option value="Lata">Lata</option>
                    </select>
                </div>
                @error('material')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="capacidad">Capacidad</label>
                    <input type="number" step="0.01" name="capacidad" id="capacidad" class="form-control" required>
                </div>
                @error('capacidad')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="unidades">Unidades</label>
                    <select name="unidades" id="unidades" class="form-control" required>
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="1">1 und</option>
                        <option value="2">2 und</option>
                        <option value="3">3 und</option>
                        <option value="6">6 und</option>
                        <option value="12">12 und</option>
                    </select>
                </div>
                @error('unidades')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="existencias">Existencias</label>
                    <input type="number" name="existencias" id="existencias" class="form-control" required>
                </div>
                @error('existencias')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="precioCompra">Precio de Compra</label>
                    <input type="number" step="0.01" name="precioCompra" id="precioCompra" class="form-control">
                </div>
                @error('precioCompra')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="precioVenta">Precio de Venta</label>
                    <input type="number" step="0.01" name="precioVenta" id="precioVenta" class="form-control" required>
                </div>
                @error('precioVenta')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item">
                    <label for="descripcion">Descripción</label>
                    {{-- <input type="text" name="descripcion" id="descripcion" class="form-control" readonly> --}}
                    <input type="text" name="descripcion" id="descripcion" class="form-control">
                </div>
                @error('descripcion')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="item item-upload">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control">
                </div>
                @error('imagen')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary">Guardar Producto</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('productForm');
            const inputs = form.querySelectorAll('input, select');
            const descripcion = document.getElementById('descripcion');

            function updateDescription() {
                const sabor = form.sabor.value;
                const tipoBebida = form.tipoBebida.value;
                const marca = form.marca.value;
                const material = form.material.value;
                const capacidad = form.capacidad.value;
                const unidades = form.unidades.value;

                descripcion.value = `${tipoBebida} ${marca} ${sabor} ${material} ${capacidad}ml x ${unidades}und`;
            }

            inputs.forEach(input => {
                input.addEventListener('input', updateDescription);
                input.addEventListener('change', updateDescription);
            });
        });
    </script>
@endsection
