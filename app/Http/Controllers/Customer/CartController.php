<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart', compact('cart'));
    }


    //add new item to cart
    public function add(Request $request)
    {
        try {
            $product = Product::findorfail($request->product_id);

            $cart = session()->get('cart', []);

            //if product exists before

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;   //only increase the quantity
            } else {
                $cart[$product->id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => 1,
                    "image" => $product->image
                ];
            }

            // save in session 
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Some Thing Went Wrong' . $e->getMessage());
        }
    }
    public function update(Request $request)
    {
        try {
            $product = Product::findorfail($request->product_id);

            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] = $request->input('quantity', 1);

                // save in session 
                session()->put('cart', $cart);

                return redirect()->back()->with('success', 'Added To Cart Successfully');
            }
            return redirect()->back()->with('error', 'Some Thing Went Wrong');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Some Thing Went Wrong' . $e->getMessage());
        }
    }

    public function remove(Request $request)
    {
        try {
            $product = Product::findorfail($request->product_id);

            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                //remove this product
                unset($cart[$product->id]);

                //save cart after update
                session()->put('cart', $cart);

                return redirect()->back()->with('success', 'Removed From Cart');
            }

            return redirect()->back()->with('error', 'Item not found in your cart');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Some Thing Went Wrong' . $e->getMessage());
        }
    }
}