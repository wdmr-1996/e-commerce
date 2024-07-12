<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'total' => 'required|numeric|min:0',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $validated['total'],
        ]);

        foreach ($validated['items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json(['id' => $order->id], 201);
    }

    public function captureOrder(Request $request)
{
    if ($request->isMethod('post')) {
        // Procesamiento para POST
        // ...
    } else {
        // Manejo de método no permitido para otros métodos
        return response()->json([
            'error' => 'MethodNotAllowed',
            'message' => 'Método no permitido para esta ruta. Utiliza POST.'
        ], 405);
    }
}

}
