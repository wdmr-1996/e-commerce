<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('forms.createProduct');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sabor' => 'nullable|string|max:255',
            'descripcion' => 'required|string|max:255',
            'material' => 'required|string|max:255',
            'capacidad' => 'required|numeric',
            'unidades' => 'required|integer',
            'tipoBebida' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'existencias' => 'required|integer',
            'precioCompra' => 'nullable|numeric',
            'precioVenta' => 'required|numeric',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Manejar la carga de la imagen
        if ($request->hasFile('imagen')) {
            $imageName = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('images/uploads'), $imageName);
            $validatedData['imagen'] = './images/uploads/' . $imageName;
            
        }

        Producto::create($validatedData);

        return redirect()->route('product.create')->with('success', 'Producto creado con éxito');
    }

    public function list()
    {
        $productos = Producto::all();
        return view('forms.listProduct', compact('productos'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('forms.editProduct', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'sabor' => 'nullable|string|max:255',
            'descripcion' => 'required|string|max:255',
            'material' => 'required|string|max:255',
            'capacidad' => 'required|numeric',
            'unidades' => 'required|integer',
            'tipoBebida' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'existencias' => 'required|integer',
            'precioCompra' => 'nullable|numeric',
            'precioVenta' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $producto = Producto::findOrFail($id);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen antigua si existe
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                unlink(public_path($producto->imagen));
            }

            // Guardar la nueva imagen
            $imageName = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('images/uploads'), $imageName);
            $validatedData['imagen'] = './images/uploads/' . $imageName;
        } else {
            // Mantener la imagen existente si no se carga una nueva
            $validatedData['imagen'] = $producto->imagen;
        }

        $producto->update($validatedData);

        return redirect()->route('product.list')->with('success', 'Producto actualizado con éxito');
    }
    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'sabor' => 'nullable|string|max:255',
    //         'descripcion' => 'required|string|max:255',
    //         'material' => 'required|string|max:255',
    //         'capacidad' => 'required|numeric',
    //         'unidades' => 'required|integer',
    //         'tipoBebida' => 'required|string|max:255',
    //         'marca' => 'required|string|max:255',
    //         'existencias' => 'required|integer',
    //         'precioCompra' => 'nullable|numeric',
    //         'precioVenta' => 'required|numeric',
    //         'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $producto = Producto::findOrFail($id);
    //     $producto->update($validatedData);

    //     return redirect()->route('product.list')->with('success', 'Producto actualizado con éxito');
    // }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('product.list')->with('success', 'Producto eliminado con éxito');
    }
}
