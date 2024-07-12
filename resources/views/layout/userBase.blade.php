<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Base</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    {{-- <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <script src="https://kit.fontawesome.com/9371cd63b1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <div class="logoContent">
            <div class="logo">
                <img src="{{ asset('images/iconos/distriliquidos.png') }}" alt="logo">
                <div class="logoName">Distriliquidos</div>
            </div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <ul class="navList">
            <li>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li>
            <li>
                <a href="{{ route('product.create') }}">
                    <i class="fa-solid fa-pen-nib"></i>
                    <span class="linksName">Nuevo producto</span>
                </a>
                <span class="tooltip">Nuevo producto</span>
            </li>
            
            <li>
                <a href="{{ route('product.list') }}">
                    <i class="fa-solid fa-table-list"></i>
                    <span class="linksName">Inventario</span>
                </a>
                <span class="tooltip">Inventario</span>
            </li>

            <li>
                <a href="{{ route('admin.create') }}">
                    <i class="fa-solid fa-rectangle-ad"></i>
                    <span class="linksName">Registrar un administrador</span>
                </a>
                <span class="tooltip">Registrar un administrador</span>
            </li>

            <li>
                <a href="{{ route('user.list') }}">
                    <i class="fa-solid fa-users"></i>
                    <span class="linksName">Usuarios</span>
                </a>
                <span class="tooltip">Usuarios</span>
            </li>


            @if (Auth::check() && Auth::user()->role == 1)
                <li>
                    <a href="{{ route('admin.panel') }}">
                        <i class="fa-brands fa-black-tie"></i>
                        <span class="linksName">Panel de administración</span>
                    </a>
                    <span class="tooltip">Panel de administración</span>
                </li>
            @endif

            
            @if (Auth::check() && Auth::user()->role == 0)
                <li>
                    <a href="{{ route('user.panel') }}">
                        <i class="fa-solid fa-person-shelter"></i>
                        <span class="linksName">Opciones de usuario</span>
                    </a>
                    <span class="tooltip">Opciones de usuario</span>
                </li>
            @endif

            {{-- <li>
                <a href="{{ route('cart.show') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="linksName">Carrito</span>
                </a>
                <span class="tooltip">Carrito</span>
            </li>
            <li>
                <a href="{{ route('catalog') }}">
                    <i class="fa-solid fa-box"></i>
                    <span class="linksName">Catalogo</span>
                </a>
                <span class="tooltip">Catalogo</span>
            </li> --}}

            {{-- <i class="fa-solid fa-right-from-bracket"></i> --}}
        </ul>

        <div class="profileContent">
            <div class="profile">
                <div class="profileDetails">
                    <img src="https://api.dicebear.com/8.x/bottts-neutral/svg" alt="fotoPerfil">
                    <div class="nameJob">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="job">Cliente</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fa-solid fa-right-from-bracket" id="logout-btn"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
    <div class="homeContent">
        @yield('userContent')
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
    
    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let searchBtn = document.querySelector(".fa-magnifying-glass");

        btn.onclick = function(){
            sidebar.classList.toggle("active");
        }
        searchBtn.onclick = function(){
            sidebar.classList.toggle("active");
        }
    </script>

</body>
</html>
