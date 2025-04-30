<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Session as LaravelSession;
use App\Models\Product;

class CheckoutController extends Controller
{
    // Show checkout form
    public function checkoutForm()
    {
        return view('shop.checkout');
    }

    // Process form and redirect to Stripe
    public function createCheckoutSession(Request $request)
    {
        LaravelSession::put('checkout_data', $request->all());

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cart = LaravelSession::get('cart', []);
        $line_items = [];

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if (!$product) continue;

            $line_items[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => intval($product->price * 100), // Convert to cents
                ],
                'quantity' => $item['quantity'],
            ];
        }

        if (empty($line_items)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty or invalid products.');
        }

        $checkout_session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect($checkout_session->url);
    }

    // Payment success
    public function success()
{
    $user_data = \Session::get('checkout_data');

    // ✅ Clear the cart session
    \Session::forget('cart');

    return view('checkout.success', compact('user_data'));
}

    // Payment cancel
    public function cancel()
    {
        return view('checkout.cancel');
    }
}
