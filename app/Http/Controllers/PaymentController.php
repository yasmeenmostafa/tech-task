<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Charge;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Webhook;

class PaymentController extends Controller
{
    public function chargeform()
    {
        return view('payment');
    }
    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => 1000, // $10.00
            'currency' => 'usd',
            
        ]);

        Payment::create([
            'payment_intent_id' => $paymentIntent->id,
            'amount' => 10.00
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }

    public function handle(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded($event->data->object);
                break;
            case 'payment_intent.payment_failed':
                $this->handlePaymentIntentFailed($event->data->object);
                break;
            // Handle other event types if necessary
            default:
                return response()->json(['message' => 'Event type not handled'], 400);
        }

        return response()->json(['message' => 'Event handled'], 200);
    }

    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        $order = Order::where('payment_intent_id', $paymentIntent->id)->first();
        if ($order) {
            $order->update(['status' => 'paid']);
        }
    }

    protected function handlePaymentIntentFailed($paymentIntent)
    {
        $order = Order::where('payment_intent_id', $paymentIntent->id)->first();
        if ($order) {
            $order->update(['status' => 'failed']);
        }
    }
}
