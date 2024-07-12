@extends('layout.base')

@section('content')
<div class="catalogContainer">
    <h1>Catalogo de productos</h1>
    <div class="filterContainer">
        <div class="filter-group">
            <label for="tipoBebida">Tipo de Bebida:</label>
            <select id="tipoBebida" name="tipoBebida" class="custom-select">
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
        <div class="filter-group" id="marcaGroup" style="display:none;">
            <label for="marcaBebida">Marca:</label>
            <select id="marcaBebida" class="my-select">
                <option value="">Seleccione</option>
                <!-- Las opciones se agregarán dinámicamente -->
            </select>
        </div>
        <div class="filter-group">
            <label for="material">Material:</label>
            <select id="material" name="material" class="custom-select">
                <option value="" disabled selected>Selecciona una opción</option>
                <option value="PET">PET</option>
                <option value="Tetrapack">Tetrapack</option>
                <option value="Vidrio">Vidrio</option>
                <option value="Lata">Lata</option>
            </select>
        </div>
        <button id="resetFilters" class="filter-group">Quitar filtros</button>
    </div>

    <div class="containerProducts" id="containerProducts">
        @include('partials.productos', ['productos' => $productos])
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipoBebida = document.getElementById('tipoBebida');
        const marcaGroup = document.getElementById('marcaGroup');
        const marcaBebida = document.getElementById('marcaBebida');
        const material = document.getElementById('material');
        const resetFilters = document.getElementById('resetFilters');
        
        const marcas = {
            agua: ["Brisa", "Cristal", "Manantial", "Brisa"],
            hidratante: ["Gatorade", "Pedialite", "Electrolit"],
            soda: ["Hatsu", "Bretaña", "Canada Dry"],
            mezclador: ["Hatsu", "Bretaña", "Canada Dry"],
            cerveza: ["Aguila", "Club Colombia", "Corona", "Budweiser", "Andina"],
            licor: ["Aguardiente Antioqueño", "Ron Medellín", "Old Parr", "Buchanan's"],
            gaseosa: ["Pool", "Coca-Cola", "Pepsi"],
            refresco: ["Fanta", "Sprite", ""],
            jugo: ["Hit", "California", "Nectar"],
            energizante: ["Speed Max", "Gatorade", "Vive100", "RedBull"],
            teEInfusiones: ["Lipton", "Twinings", "Té Hindú"]
        };

        function filterProducts() {
            const tipoSeleccionado = tipoBebida.value;
            const marcaSeleccionada = marcaBebida.value;
            const materialSeleccionado = material.value;

            document.querySelectorAll('.card').forEach(card => {
                const matchTipo = !tipoSeleccionado || card.dataset.tipobebida.toLowerCase() === tipoSeleccionado.toLowerCase();
                const matchMarca = !marcaSeleccionada || card.dataset.marca.toLowerCase() === marcaSeleccionada.toLowerCase();
                const matchMaterial = !materialSeleccionado || card.dataset.material.toLowerCase() === materialSeleccionado.toLowerCase();

                if (matchTipo && matchMarca && matchMaterial) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function showAllProducts() {
            document.querySelectorAll('.card').forEach(card => {
                card.style.display = 'block';
            });
        }

        tipoBebida.addEventListener('change', function() {
            const tipoSeleccionado = tipoBebida.value;
            if (tipoSeleccionado) {
                marcaGroup.style.display = 'block';
                marcaBebida.innerHTML = '<option value="">Seleccione</option>';
                marcas[tipoSeleccionado.toLowerCase()].forEach(function(marca) {
                    const option = document.createElement('option');
                    option.value = marca.toLowerCase();
                    option.textContent = marca;
                    marcaBebida.appendChild(option);
                });
                filterProducts();
            } else {
                marcaGroup.style.display = 'none';
                marcaBebida.innerHTML = '';
                showAllProducts();
            }
            filterProducts();
        });

        marcaBebida.addEventListener('change', filterProducts);
        material.addEventListener('change', filterProducts);

        resetFilters.addEventListener('click', function() {
            tipoBebida.selectedIndex = 0;
            marcaBebida.selectedIndex = 0;
            material.selectedIndex = 0;
            marcaGroup.style.display = 'none';
            showAllProducts();
        });

        function attachEventListeners() {
            document.querySelectorAll('.btn-minus').forEach(function (btnMinus) {
                btnMinus.addEventListener('click', function () {
                    const card = btnMinus.closest('.card');
                    const cantidadElem = card.querySelector('.cardCantidad');
                    const precioElem = card.querySelector('.precioTotal');
                    let cantidad = parseInt(cantidadElem.textContent);
                    const precio = parseInt(card.dataset.precio);

                    if (cantidad > 1) {
                        cantidad--;
                        cantidadElem.textContent = cantidad;
                        precioElem.textContent = (cantidad * precio).toLocaleString('es-ES') + ' COP';
                    }
                });
            });

            document.querySelectorAll('.btn-plus').forEach(function (btnPlus) {
                btnPlus.addEventListener('click', function () {
                    const card = btnPlus.closest('.card');
                    const cantidadElem = card.querySelector('.cardCantidad');
                    const precioElem = card.querySelector('.precioTotal');
                    let cantidad = parseInt(cantidadElem.textContent);
                    const maxQuantity = parseInt(card.dataset.existencias);
                    const precio = parseInt(card.dataset.precio);

                    if (cantidad < maxQuantity) {
                        cantidad++;
                        cantidadElem.textContent = cantidad;
                        precioElem.textContent = (cantidad * precio).toLocaleString('es-ES') + ' COP';
                    }
                });
            });

            document.querySelectorAll('.btn-add-to-cart').forEach(function (btnAddToCart) {
                btnAddToCart.addEventListener('click', function () {
                    const card = btnAddToCart.closest('.card');
                    const productId = card.dataset.id;
                    const productName = card.dataset.descripcion;
                    const productPrice = parseInt(card.dataset.precio);
                    const productQuantity = parseInt(card.querySelector('.cardCantidad').textContent);
                    const productImage = card.dataset.imagen;

                    fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            id: productId,
                            name: productName,
                            price: productPrice,
                            quantity: productQuantity,
                            image: productImage
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Producto agregado al carrito');
                            } else {
                                alert('Error al agregar producto al carrito');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al agregar producto al carrito');
                        });
                });
            });
        }

        function updatePrice(card, quantity) {
            const priceElement = card.querySelector('.precioTotal');
            const unitPrice = parseFloat(card.dataset.precio);
            const totalPrice = unitPrice * quantity;
            priceElement.textContent = new Intl.NumberFormat('es-CO').format(totalPrice);
        }

        attachEventListeners();
    });
</script>

@endsection
