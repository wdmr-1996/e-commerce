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
                <a href="{{ route('catalog') }}">
                    <i class="fa-solid fa-box"></i>
                    <span class="linksName">Catalogo</span>
                </a>
                <span class="tooltip">Catalogo</span>
            </li>

            <li>
                <a href="{{ route('cart.show') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="linksName">Carrito</span>
                </a>
                <span class="tooltip">Carrito</span>
            </li>
            <li>
                <a href="">
                    <i class="fa-solid fa-heart"></i>
                    <span class="linksName">Guardado</span>
                </a>
                <span class="tooltip">Guardado</span>
            </li>
            <li>
                <a href="">
                    <i class="fa-solid fa-phone"></i>
                    <span class="linksName">Contactanos</span>
                </a>
                <span class="tooltip">Contactanos</span>
            </li>
            {{-- <li>
                <a href="">
                    <i class="fa-solid fa-globe"></i>
                    <span class="linksName">Quienes somos</span>
                </a>
                <span class="tooltip">Quienes somos</span>
            </li> --}}
            
            <li>
                <a href="https://www.stack-ai.com/chat-assistant/2cfc4165-7c6b-401a-8a43-e25dfd213a51/b4dc9ec5-4a62-4225-ae35-308530067da5/6678a2f126e91c80d8cb1c2c" class="whatsapp-button" target="_blank">
                    <i class="fa-solid fa-comments"></i>
                    <span class="linksName">Asistente</span>
                </a>
                <span class="tooltip">Asistente</span>
            </li>

            @guest
                <li>
                    <a href="{{ route('login') }}">
                        <i class="fa-solid fa-user"></i>
                        <span class="linksName">Usuario</span>
                    </a>
                    <span class="tooltip">Usuario</span>
                </li>
            @endguest

            {{-- @auth
                <li>
                    <a href="">
                        <i class="fa-solid fa-user"></i>
                        <span class="linksName">Perfil</span>
                    </a>
                    <span class="tooltip">Perfil</span>
                </li>
            @endauth --}}

            <li>
                <a href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i>
                    <span class="linksName">Inicio</span>
                </a>
                <span class="tooltip">Inicio</span>
            </li>
            
        </ul>
        <!--<div class="profileContent">
            <div class="profile">
                <div class="profileDetails">
                    <img src="https://api.dicebear.com/8.x/bottts-neutral/svg" alt="fotoPerfil">
                    <div class="nameJob">
                        <div class="name">Rogelio</div>
                        {{-- <div class="job">Cliente</div> --}}
                    </div>
                </div>
                <i class="fa-solid fa-right-from-bracket" id="logOut"></i>
            </div>
        </div>--->
    </div>
    <div class="homeContent">
        @yield('content')
    </div>

    {{-- <a href="https://www.stack-ai.com/chat-assistant/2cfc4165-7c6b-401a-8a43-e25dfd213a51/b4dc9ec5-4a62-4225-ae35-308530067da5/6678a2f126e91c80d8cb1c2c" class="whatsapp-button" target="_blank">
        <i class="fa-brands fa-whatsapp"></i>
    </a> --}}

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
    {{-- <script
        src="https://unpkg.com/react-stackai@latest/dist/vanilla/vanilla-stackai.js"
        data-project-url="https://www.stack-ai.com/embed/2cfc4165-7c6b-401a-8a43-e25dfd213a51/b4dc9ec5-4a62-4225-ae35-308530067da5/6678a2f126e91c80d8cb1c2c">
    </script> --}}

</body>
</html>
