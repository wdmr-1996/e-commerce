@extends('layout.base')

@section('content')
    <div class="containerLoginSignin">
        <div class="containerLogin">
            <h1>Crear una Cuenta 💻</h1>

            <form action="{{ route('signin.post') }}" method="POST">

                @csrf

                <label for="name">Nombre</label>
                <div class="custome-input">
                    <input type="text" name="name" placeholder="Escriba su Nombre..." autocomplete="off">
                    <i class='bx bx-user'></i>
                </div>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="lastname">Apellido</label>
                <div class="custome-input">
                    <input type="text" name="lastname" placeholder="Escriba su Apellido..." autocomplete="off">
                    <i class='bx bx-user'></i>
                </div>
                @error('lastname')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="email">Correo Electrónico</label>
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

                <label for="cpassword">Confirma tu contraseña</label>
                <div class="custome-input">
                    <input type="password" name="cpassword" placeholder="Confirma tu Contraseña...">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                @error('cpassword')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button class="login">Registrarse</button>
                <div class="links"></div>
                <a href="{{ route('login.post') }}">¿Ya tienes una Cuenta?</a>
            </form>

            @if(Session::has('message'))
                <div class="container">
                    <div class="alert alert-{{Session::get('typealert')}}" style="display:none;">
                        {{Session::get('message')}}
                        @if ($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="alert">{{$error}}</li>
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