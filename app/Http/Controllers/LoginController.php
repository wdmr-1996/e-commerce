<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Producto;

class LoginController extends Controller
{
    public function getHome()
    {
        return view('catalog');
    }
    public function getLogin()
    {
        return view('forms.login');
    }

    public function postLogin(Request $request)
    {
        // Definir las reglas de validación
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];

        // Definir los mensajes de error personalizados
        $messages = [
            'email.required' => 'Su correo electrónico es requerido',
            'email.email' => 'Se requiere un correo electrónico válido',
            'password.required' => 'Su contraseña es requerida',
            'password.min' => 'Su contraseña debe tener al menos 8 caracteres',
        ];

        // Crear un validador
        $validator = Validator::make($request->all(), $rules, $messages);

         // Comprobar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        }

        // Intentar autenticar al usuario
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)){
                    // Obtener el rol del usuario autenticado
            $role = Auth::user()->role;
            // Redirigir según el rol del usuario
            if ($role == 0) {
                return redirect()->route('user.panel');
            } elseif ($role == 1) {
                return redirect()->route('admin.panel');
            }
        } else {
            return redirect()->back()
            ->withErrors($validator)
            // ->withErrors(['login' => 'Credenciales incorrectas'])
            ->with('message', 'Credenciales incorrectas:')
            ->with('typealert', 'danger');
        }
        
        // return view('panels.userPanel');
    }

    public function userPanel()
    {
        return view('panels.userPanel');
    }

    public function adminPanel()
    {
        return view('panels.adminPanel');
    }

    public function postLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('message', 'Sesión cerrada exitosamente')->with('typealert', 'success');
    }

    public function __construct() {
    // Cualquier funcion o metodo de éste controlador solo se pueden ejecutar si y solo si el usuario es un visitante, es decir, que no se ha logueado
        $this->middleware('guest')->except(['getLogout','userPanel', 'adminPanel', 'postLogin']);
        // Solo los usuarios que se han logueado pueden acceder al panel de usuario
        $this->middleware('auth')->only('userPanel', 'adminPanel', 'postLogout');
    }

    public function getSignin()
    {
        return view('forms.signin');
    }

    public function postSignin(Request $request)
    {
        // Definir las reglas de validación
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password'
        ];


        // Definir los mensajes de error personalizados
        $messages = [
            'name.required' => 'Su nombre es requerido',
            'lastname.required' => 'Su apellido es requerido',
            'email.required' => 'Su correo electrónico es requerido',
            'email.email' => 'Se requiere un correo electrónico válido',
            'email.unique' => 'Ya existe un usuario con este correo electrónico',
            'password.required' => 'Su contraseña es requerida',
            'password.min' => 'Su contraseña debe tener al menos 8 caracteres',
            'cpassword.required' => 'La confirmación de su contraseña es requerida',
            'cpassword.same' => 'La contraseña y la confirmación de la contraseña deben ser iguales'
        ];

        // Crear el validador
        $validator = Validator::make($request->all(), $rules, $messages);

        // Comprobar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->with('message', 'Se ha producido un error')
            ->with('typealert', 'danger');
        }
        
        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')
            ->with('message', 'Usuario registrado con éxito')
            ->with('typealert', 'success');
        
    }
}

