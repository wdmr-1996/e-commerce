<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function showAdminBase()
    {
        return view('layout.adminBase');
    }

    public function create()
    {
        return view('forms.createAdmin');
    }
    
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el nuevo administrador
        User::create([
            'role' => 1, // Establecer el rol como 1 para administrador
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirigir a una página de éxito o de nuevo registro
        return redirect()->route('admin.panel')->with('success', 'Administrador creado exitosamente.');
    }

    public function listUser(Request $request)
    {
        $role = $request->input('role', 'all');
    
        if ($role === 'admin') {
            $users = User::where('role', 1)->get();
        } elseif ($role === 'client') {
            $users = User::where('role', 0)->get();
        } else {
            $users = User::all();
        }
    
        return view('forms.listUsers', compact('users', 'role'));
    }
    
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('forms.editUser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario de edición
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Encontrar al usuario por su ID
        $user = User::findOrFail($id);

        // Actualizar los campos del usuario
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        // Actualizar la contraseña si se ha proporcionado una nueva
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Guardar los cambios
        $user->save();

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('user.list')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        // Encontrar el usuario por su ID
        $user = User::findOrFail($id);

        // Eliminar el usuario
        $user->delete();

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('user.list')->with('success', 'Usuario eliminado correctamente.');
    }
}