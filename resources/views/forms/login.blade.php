@extends('layout.base')

@section('content')
    <div class="containerLoginSignin">
        <div class="containerLogin">

            <form method="POST" action="{{route('login.post')}}">
                @csrf
                <label for="email">Correo Electronico</label>
                <div class="custome-input">
                    <input type="email" name="email" placeholder="Escriba su Correo..." autocomplete="off">
                    <i class='bx bx-at'></i>
                </div>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="password">Contraseña</label>
                <div class="custome-input">
                    <input type="password" name="password" placeholder="Escriba su Contraseña...">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button class="login">Iniciar Sesion</button>
                <div class="links"></div>
            </form>
            
            @if(session('message'))
                <div class="alert alert-{{ session('typealert') }}">
                    {{ session('message') }}
                </div>
                <script>
                    console.log("{{ session('message') }}");
                </script>
            @endif
            
            {{-- <h1>💻Ingresar con:</h1> --}}
            <h5 for="">También puedes ingresar con:</h5>
            <div class="social-login">
                <button class="google">
                    <i class='bx bxl-google'></i>
                    Google
                </button>
                <button class="google">
                    <i class='bx bxl-apple'></i>
                    Apple
                </button>
            </div>
            
            <div class="divider">
                <div class="line"></div>
                <p>O</p>
                <div class="line"></div>
            </div>

            <a href="#">Olvidaste tu ontraseña?</a>
            <a href="{{route('signin')}}">Aún NO tienes una Cuenta?</a>


            @if(Session::has('message'))
                <div class="container">
                    <div class="alert alert-{{Session::get('typealert')}}" style="display:none;">
                        {{Session::get('message')}}
                        @if ($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif

                        <script>
                            $('.alert').slideDown();
                            setTimeout(function(){ $('.alert').slideUp();}, 1000);2r
                        </script>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection