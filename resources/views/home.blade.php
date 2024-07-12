<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distriliquidos MV</title>
    {{-- <link rel="stylesheet" href="../Views/estilos.css"> --}}
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>

<body>
    <div class="startContainer">

        <div class="header">
            <h2>Distriliquidos MV</h2>
            <div class="search-bar">
                <input type="text" placeholder="Buscar productos, marcas y más...">
                <button type="submit"><ion-icon name="search-outline"></ion-icon></button>
            </div>
        </div>

        <div class="navbar">
            {{-- <a href="#"><ion-icon name="home-outline"></ion-icon>Inicio</a> --}}
            <a href="{{ route('catalog') }}"><ion-icon name="pricetag-outline"></ion-icon>Catalogo</a>
            @guest
                <a href="{{ route('login') }}"><ion-icon name="person-add-outline"></ion-icon>Iniciar Sesion</a>
                {{-- @else
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Cerrar Sesión</button>
                </form> --}}
            @endguest
            <a href="{{ route('cart.show') }}"><ion-icon name="cart-outline"></ion-icon>Carrito</a>
        </div>


        <div class="carousel">
            <div class="carousel-inner">
                {{-- <div class="carousel-item active">
                    <img src="{{ asset('images/start/noticiaImpuesto.jpg') }}" alt="Slide 1">
                </div> --}}
                <div class="carousel-item">
                    <img src="{{ asset('images/start/hidratantes-energizantes.jpeg') }}" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/start/banner2.webp') }}" alt="Slide 3">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/start/pixelcut-export.jpeg') }}" alt="Slide 3">
                </div>
            </div>
            <button class="carousel-control-prev" onclick="prevSlide()">&#10094;</button>
            <button class="carousel-control-next" onclick="nextSlide()">&#10095;</button>
            <div class="carousel-indicators">
                <button class="active" onclick="showSlide(0)"></button>
                <button onclick="showSlide(1)"></button>
                <button onclick="showSlide(2)"></button>
            </div>
        </div>
        <h1>Nuevos productos</h1>
        <div class="card-container">
            @foreach ($productos as $producto)
                <div class="card" data-id="{{ $producto->idProducto }}" data-existencias="{{ $producto->capacidad }}"
                    data-precio="{{ $producto->precioVenta }}" data-descripcion="{{ $producto->descripcion }}"
                    data-imagen="{{ $producto->imagen }}">
                    <img src="{{ $producto->imagen }}" alt="Producto 1">
                    <div class="card-body">
                        <h3 class="card-title">{{ $producto->descripcion }}</h3>
                        <p class="card-price">{{ number_format($producto->precioVenta, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach

            {{-- <div class="card">
                <img src="https://via.placeholder.com/300x200" alt="Producto 2">
                <div class="card-body">
                    <h3 class="card-title">Producto 2</h3>
                    <p class="card-price">$200.00</p>
                </div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/300x200" alt="Producto 3">
                <div class="card-body">
                    <h3 class="card-title">Producto 3</h3>
                    <p class="card-price">$300.00</p>
                </div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/300x200" alt="Producto 4">
                <div class="card-body">
                    <h3 class="card-title">Producto 4</h3>
                    <p class="card-price">$400.00</p>
                </div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/300x200" alt="Producto 4">
                <div class="card-body">
                    <h3 class="card-title">Producto 4</h3>
                    <p class="card-price">$400.00</p>
                </div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/300x200" alt="Producto 4">
                <div class="card-body">
                    <h3 class="card-title">Producto 4</h3>
                    <p class="card-price">$400.00</p>
                </div>
            </div> --}}
        </div>

        <!--Carrusel segundo-->
        <h1>Productos en oferta</h1>
        <div class="product-carousel">
            <div class="product-carousel-inner">
                @foreach ($productos as $producto)
                    <div class="product-carousel-item">
                        <img src="{{ $producto->imagen }}" alt="Producto">
                    </div>
                @endforeach
                {{-- 
                <div class="product-carousel-item">
                    <img src="https://via.placeholder.com/150x150" alt="Producto 1">
                </div>
                <div class="product-carousel-item">
                    <img src="https://via.placeholder.com/150x150" alt="Producto 2">
                </div>
                <div class="product-carousel-item">
                    <img src="https://via.placeholder.com/150x150" alt="Producto 3">
                </div>
                <div class="product-carousel-item">
                    <img src="https://via.placeholder.com/150x150" alt="Producto 4">
                </div>
                <div class="product-carousel-item">
                    <img src="https://via.placeholder.com/150x150" alt="Producto 5">
                </div>
                <div class="product-carousel-item">
                    <img src="https://via.placeholder.com/150x150" alt="Producto 6">
                </div>
                <div class="product-carousel-item">
                    <img src="https://via.placeholder.com/150x150" alt="Producto 7">
                </div>
                <div class="product-carousel-item">
                    <img src="https://via.placeholder.com/150x150" alt="Producto 8">
                </div>
                <div class="product-carousel-item">
                    <img src="https://via.placeholder.com/150x150" alt="Producto 9">
                </div>
                <div class="product-carousel-item">
                    <img src="https://via.placeholder.com/150x150" alt="Producto 10">
                </div> --}}
            </div>
            <button class="product-carousel-control-prev" onclick="prevProductSlide()">&#10094;</button>
            <button class="product-carousel-control-next" onclick="nextProductSlide()">&#10095;</button>
        </div>
        <!--Fin segundo Carrusel-->

        <!--Footer-->
        <footer class="footer">
            <div class="container">
                <div class="column">
                    <h3>Sobre Nosotros</h3>
                    <ul>
                        <li><a href="#">Quiénes Somos</a></li>
                        <li><a href="#">Trabaja con Nosotros</a></li>
                        <li><a href="#">Términos y Condiciones</a></li>
                        <li><a href="#">Política de Privacidad</a></li>
                    </ul>
                </div>
                <div class="column">
                    <h3>Ayuda</h3>
                    <ul>
                        <li><a href="#">Centro de Ayuda</a></li>
                        <li><a href="#">Cómo Comprar</a></li>
                        <li><a href="#">Cómo Vender</a></li>
                        <li><a href="#">Preguntas Frecuentes</a></li>
                    </ul>
                </div>
                <div class="column">
                    <h3>Redes Sociales</h3>
                    <div class="social-media">
                        <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                        <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
                        <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                        <a href="#"><ion-icon name="logo-linkedin"></ion-icon></a>
                    </div>
                </div>
                <div class="column">
                    <h3>Contacto</h3>
                    <div class="contact-info">
                        <p>Teléfono: (123) 456-7890</p>
                        <p>Email: contacto@ejemplo.com</p>
                        <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!--Fin footer-->

    <script>
        let currentSlide = 0;

        function showSlide(index) {
            const slides = document.querySelectorAll('.carousel-item');
            const totalSlides = slides.length;
            if (index >= totalSlides) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = totalSlides - 1;
            } else {
                currentSlide = index;
            }
            const offset = -currentSlide * 100 / totalSlides;
            document.querySelector('.carousel-inner').style.transform = `translateX(${offset}%)`;
            updateIndicators();
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function updateIndicators() {
            const indicators = document.querySelectorAll('.carousel-indicators button');
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSlide);
            });
        }

        setInterval(nextSlide, 5000); // Mover el carrusel cada 10 segundos

        showSlide(currentSlide);


        let currentProductSlide = 0;

        function showProductSlide(index) {
            const productSlides = document.querySelectorAll('.product-carousel-item');
            const totalProductSlides = productSlides.length / 5; // Mostrar 5 productos a la vez
            if (index >= totalProductSlides) {
                currentProductSlide = 0;
            } else if (index < 0) {
                currentProductSlide = totalProductSlides - 1;
            } else {
                currentProductSlide = index;
            }
            const offset = -currentProductSlide * 100;
            document.querySelector('.product-carousel-inner').style.transform = `translateX(${offset}%)`;
        }

        function nextProductSlide() {
            showProductSlide(currentProductSlide + 1);
        }

        function prevProductSlide() {
            showProductSlide(currentProductSlide - 1);
        }

        // Iniciar el carrusel de productos automáticamente
        setInterval(nextProductSlide, 10000); // Mover el carrusel cada 10 segundos

        showProductSlide(currentProductSlide);
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
