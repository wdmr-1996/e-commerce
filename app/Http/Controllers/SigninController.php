<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;


class SigninController extends Controller
{
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
