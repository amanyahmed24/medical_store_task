<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session('cart', []);
        return view('customer.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);


        try {
            $cart = session('cart', []);

            if (empty($cart)) {
                return redirect()->route('cart.all')->with('error', 'Cart is empty.');
            }


            $order = Order::create([
                'customer_name' => $request->full_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'total_price' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            ]);


            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            session()->forget('cart');

            return redirect()->route('checkout.confirmation', ['order_id' => $order->id])
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function confirmation($order_id)
    {
        $order = Order::with('items.product')->findOrFail($order_id);
        return view('customer.confirmation', compact('order'));
    }
}
