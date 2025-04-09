<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        $id = (string) $product->id; // ensure string key

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('shop.cart', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->input('quantities', []) as $id => $qty) {
            $id = (string) $id; // cast to string just in case
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = max(1, (int) $qty);
            }
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Cart updated.');
    }

    public function removeFromCart($id)
    {
        $id = (string) $id; // ensure string key
        $cart = session()->get('cart', []);


        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product removed from cart.');
    }

    public function checkoutForm()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Your cart is empty.');
        }
        return view('shop.checkout');
    }

    public function checkoutProcess(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        // Simulate payment success
        $success = true;

        if ($success) {
            session()->forget('cart');
            return redirect()->route('shop.index')->with('success', 'Payment successful! Your order is confirmed.');
        } else {
            return back()->with('error', 'Payment failed. Please try again.');
        }
    }
}
