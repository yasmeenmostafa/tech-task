<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $order = Order::create([
            'amount' => 1000, // Example amount
            'status' => 'pending',
            'user_id' => auth()->id(),
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $order->amount * 100, // Amount in cents
            'currency' => 'usd',
            'metadata' => ['order_id' => $order->id],
        ]);

        $order->update(['payment_intent_id' => $paymentIntent->id]);

        return view('payment', [
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }
}
