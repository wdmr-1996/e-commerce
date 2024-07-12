<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Producto;

class CartController extends Controller
{
    public function showCart()
    {
        $cartItems = session()->get('cart', []);

        foreach ($cartItems as &$item) {
            $producto = Producto::find($item['id']);
            $item['existencias'] = $producto ? $producto->existencias : 0;
        }

        return view('cart', ['cartItems' => $cartItems]);
    }

    public function addToCart(Request $request)
    {

        $product = $request->only('id', 'name', 'description', 'price', 'quantity', 'image');

        $cart = session()->get('cart', []);

        // Verificar si el ID ya existe en el array $cart
        if (!isset($cart[$product['id']])) {
            $cart[$product['id']] = $product;
            session()->put('cart', $cart);
        }
        return response()->json([
            'message' => 'Producto añadido al carrito',
            'data' => $cart,
            'session' => session()->all()
        ]);
        // return response()->json(['message' => 'Producto añadido al carrito']);
        // return response()->json([
        //     'message' => 'Producto añadido al carrito',
        //     'data' => $cart,
        //     'session' => session()->all() // Incluye todo el contenido de la sesión en la respuesta
        // ]);
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('id');
        $cart = session()->get('cart', []);
    
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
    
        return redirect()->route('cart.show')->with('message', 'Producto eliminado del carrito');
    }
}
