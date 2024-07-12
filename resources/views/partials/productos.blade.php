@foreach ($productos as $producto)
    <div class="card" data-id="{{ $producto->id }}" data-existencias="{{ $producto->capacidad }}"
        data-precio="{{ $producto->precioVenta }}" data-descripcion="{{ $producto->descripcion }}" 
        data-imagen="{{ $producto->imagen }}" data-tipoBebida="{{ $producto->tipoBebida }}"
        data-capacidad="{{ $producto->capacidad }}" data-unidades="{{ $producto->unidades }}"
        data-marca="{{ strtolower($producto->marca) }}" data-material="{{ $producto->material }}">
        <img src="{{ $producto->imagen }}" alt="Producto">
        <div class="cardContent">
            <p class="cardDescription">{{ $producto->descripcion }}</p>
            <span class="cardPlusMinus">
                <i class="fa-solid fa-square-minus"></i>
                <span class="cardCantidad">1</span>
                <i class="fa-solid fa-square-plus"></i>
                <span class="precioTotal">{{ number_format($producto->precioVenta, 0, ',', '.') }}</span>
            </span>
        </div>
        <input type="hidden" name="producto_id" value="{{ $producto->idProducto }}">
        <button type="button" class="cardButton">Agregar al carrito</button>
    </div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.card').forEach(card => {
            let cantidadElement = card.querySelector('.cardCantidad');
            let precioElement = card.querySelector('.precioTotal');
            let precio = parseFloat(card.dataset.precio);
            let existencias = parseInt(card.dataset.existencias);

            card.querySelector('.fa-square-minus').addEventListener('click', () => {
                let cantidad = parseInt(cantidadElement.textContent);
                if (cantidad > 1) {
                    cantidad--;
                    cantidadElement.textContent = cantidad;
                    precioElement.textContent = (precio * cantidad).toLocaleString('de-DE');
                }
            });

            card.querySelector('.fa-square-plus').addEventListener('click', () => {
                let cantidad = parseInt(cantidadElement.textContent);
                if (cantidad < existencias) {
                    cantidad++;
                    cantidadElement.textContent = cantidad;
                    precioElement.textContent = (precio * cantidad).toLocaleString('de-DE');
                }
            });

            card.querySelector('.cardButton').addEventListener('click', () => {
                let cantidad = parseInt(cantidadElement.textContent);
                let id = card.dataset.id;
                let descripcion = card.dataset.descripcion;
                let imagen = card.dataset.imagen;
                console.log(id)
                fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: id,
                        name: descripcion,
                        description: card.querySelector('.cardDescription').textContent,
                        price: precio,
                        quantity: cantidad,
                        image: imagen
                    })
                }).then(response => response.json())
                .then(data => {
                    console.log(data)
                    if (data.message) {
                        alert(data.message);
                    }
                }).catch(error => console.error('Error:', error));
            });
        });
    });
</script>
