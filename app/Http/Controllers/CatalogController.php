<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;


class CatalogController extends Controller
{
    public function catalog(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('tipoBebida')) {
            $query->where('tipoBebida', $request->input('tipoBebida'));
        }

        if ($request->filled('marcaBebida')) {
            $query->where('marca', $request->input('marcaBebida'));
        }

        $productos = $query->get();

        if ($request->ajax()) {
            return view('partials.productos', compact('productos'))->render();
        }

        return view('layout.catalog', compact('productos'));
    }

    public function getMarcas(Request $request)
    {
        // 
    }



    public function muestras(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('tipoBebida')) {
            $query->where('tipoBebida', $request->input('tipoBebida'));
        }

        if ($request->filled('marcaBebida')) {
            $query->where('marca', $request->input('marcaBebida'));
        }

        $productos = $query->get();

        if ($request->ajax()) {
            return view('home', compact('productos'))->render();
        }

        return view('home', compact('productos'));
    }
}
