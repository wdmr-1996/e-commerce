@extends('layout.base')

@section('content')
<div class="cartContainer">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <h1>Carrito</h1>
    <div class="cartItems">
        @if(empty($cartItems))
        <p>No hay productos seleccionados.</p>
        @else
        @foreach ($cartItems as $item)
        <div class="cartItem" data-id="{{ $item['id'] }}">
            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="cartImage" id="img-carrito">
            <div class="cartItemDetails">
                <div class="itemNombreContainer">
                    <span class="itemNombre">{{ $item['name'] }}</span>
                </div>
                <div class="itemDescription">
                    <span class="itemCantidad">
                        <i class="fa-solid fa-square-minus" aria-hidden="true"></i>
                        <span id="cant-carrito">Cantidad: {{ $item['quantity'] }}</span>
                        <i class="fa-solid fa-square-plus" aria-hidden="true"></i>
                    </span>
                    <span class="itemPrecio">
                        <span id="prec-carrito" data-unit-price="{{ $item['price'] }}">Precio:
                            {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                    </span>
                </div>
            </div>

            <form action="{{ route('cart.remove') }}" method="post" class="cartEliminar remove-form">
                @csrf
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button type="submit" class="btnEliminar">
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        @endforeach
        @endif
    </div>
    @if(!empty($cartItems))
    <div class="cartActions">
        <div id="paypal-button-container"></div>
    </div>
    @endif
</div>

<!-- Incluir el SDK de PayPal -->
<script src="https://www.paypal.com/sdk/js?client-id=AZYbRdtw_EkMCdjYqL4ULYykT9ZKmQkQTyuH8PK_iAlxnGReVFfC08dRcvtoWBxynn-wCqX0qhdfgcFu&currency=USD"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var paypalScript = document.createElement('script');
        paypalScript.src = 'https://www.paypal.com/sdk/js?client-id=AZYbRdtw_EkMCdjYqL4ULYykT9ZKmQkQTyuH8PK_iAlxnGReVFfC08dRcvtoWBxynn-wCqX0qhdfgcFu&currency=USD';
        paypalScript.onload = function() {
            // Aquí colocas el código para inicializar los botones de PayPal
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: 100
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        return fetch("{{ route('order.captureD') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                details: details
                            })
                        }).then(function(response) {
                            return response.json();
                        }).then(function(orderData) {
                            alert('Transacción completada por ' + orderData.payer.name.given_name);
                        });
                    });
                }
            }).render('#paypal-button-container');
        };
        document.body.appendChild(paypalScript);
    });

    function calculaTotal() {
        // Implementa la lógica para calcular el total del carrito
        // Aquí puedes sumar los precios de los productos en el carrito
        // y devolver el total calculado.
        return 100; // Ejemplo de total fijo para propósitos de prueba
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.cartItem').forEach(item => {
            let cantidadElement = item.querySelector('#cant-carrito');
            let precioElement = item.querySelector('#prec-carrito');
            let precioUnitario = parseFloat(precioElement.dataset.unitPrice);

            item.querySelector('.fa-square-minus').addEventListener('click', () => {
                let cantidad = parseInt(cantidadElement.textContent.split(': ')[1]);
                if (cantidad > 1) {
                    cantidad--;
                    cantidadElement.textContent = `Cantidad: ${cantidad}`;
                    precioElement.textContent = `Precio: ${(precioUnitario * cantidad).toLocaleString('de-DE')}`;
                }
            });

            item.querySelector('.fa-square-plus').addEventListener('click', () => {
                let cantidad = parseInt(cantidadElement.textContent.split(': ')[1]);
                cantidad++;
                cantidadElement.textContent = `Cantidad: ${cantidad}`;
                precioElement.textContent = `Precio: ${(precioUnitario * cantidad).toLocaleString('de-DE')}`;
            });

            document.querySelectorAll('.btnEliminar').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    var form = this.closest('.remove-form');
                    form.submit();
                });
            });
        });
    });
</script>
@endsection
