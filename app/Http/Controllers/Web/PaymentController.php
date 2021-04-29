<?php

namespace App\Http\Controllers\Web;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Api\Orders;
use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{


    public function paymentPage()
    {
        $carts = Cart::content();
        $setting = Setting::first();
        return view('web.payment.payment', compact('carts', 'setting'));
    }


    public function payment(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:20',
            'address' => 'required',
            'city' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'payment_type' => $request->payment_type,
        ];

        $carts = Cart::Content();
        $setting = Setting::first();

        if ($request->payment_type == 'stripe') {
            return view('web.payment.stripe', compact('data', 'carts', 'setting'));

        } elseif ($request->payment_type == 'paypal') {
            return view('web.payment.paypal', compact('data'));

        } elseif ($request->payment_type == 'cash') {
            return view('web.payment.cash', compact('data', 'carts', 'setting'));
        }
    }


    public function chargeStripe(Request $request)
    {
        $email = auth()->user()->email;
        $name = auth()->user()->name;
        $total = $request->total;

        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        Stripe::setApiKey('sk_test_51Ij40OGOmOZDR7EDftt5Erbv4yS2MRW9x375Ef1Z0LYcxHPjh2zIdsvVSzp7FTMfcjyoPCDrQ2iQyy3mzUz2kxmE00MVAT3Dgf');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];


        $charge =  Charge::create([
            'amount' => $total * 100,
            'currency' => 'usd',
            'description' => 'Abdo Ecommerce Project',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);





        $order = [
            'user_id' => auth()->id(),

            'payment_id' => $charge->payment_method,
            'paying_amount' => $charge->amount,
            'balance_transaction' => $charge->balance_transaction,
            'stripe_order_id' => $charge->metadata->order_id,


            'payment_type' => $request->payment_type,

            'subtotal' => $request->subtotal,
            'shipping_charge' => $request->shipping_charge,
            'vat' => $request->vat,
            'total' => $request->total,
            'status_code' => mt_rand(10000, 99999),

            'date' => date('d-m-y'),
            'month' => date('F'),
            'year' => date('Y'),
        ];

        // $order_id = Order::insert($order)->id;
        $order_id = Order::insertGetId($order);

        Mail::to($email)->send(new InvoiceMail($order, $name, $email));

        // insert shipping table
        $shipping = [
            'oredr_id' => $order_id,
            'ship_name' => $request->ship_name,
            'ship_email' => $request->ship_email,
            'ship_phone' => $request->ship_phone,
            'ship_address' => $request->ship_address,
            'ship_city' => $request->ship_city,
        ];

        Shipping::insert($shipping);

        // insert order-details table
        $contents = Cart::content();
        foreach ($contents as $content) {
            OrderDetail::create([
                'order_id' => $order_id,
                'product_id' => $content->id,
                'product_name' => $content->name,
                'color' => $content->options->color,
                'size' => $content->options->size,
                'qty' => $content->qty,
                'singleprice' => $content->price,
                'totalprice' => $content->qty * $content->price,
            ]);
        }
        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notifiction =  array(
            'message' => 'process completed',
            'alert-type' => 'success'
        );
        return Redirect()->to('/')->with($notifiction);
    }

    public function chargeCash(Request $request)
    {

        $order = [
            'user_id' => auth()->id(),


            'payment_type' => $request->payment_type,
            'subtotal' => $request->subtotal,
            'shipping_charge' => $request->shipping_charge,
            'vat' => $request->vat,
            'total' => $request->total,
            'status_code' => mt_rand(10000, 99999),

            'date' => date('d-m-y'),
            'month' => date('F'),
            'year' => date('Y'),
        ];


        $order_id = Order::insertGetId($order);


        // insert shipping table
        $shipping = [
            'oredr_id' => $order_id,
            'ship_name' => $request->ship_name,
            'ship_email' => $request->ship_email,
            'ship_phone' => $request->ship_phone,
            'ship_address' => $request->ship_address,
            'ship_city' => $request->ship_city,
        ];

        Shipping::insert($shipping);

        // insert order-details table
        $contents = Cart::content();
        foreach ($contents as $content) {
            OrderDetail::create([
                'order_id' => $order_id,
                'product_id' => $content->id,
                'product_name' => $content->name,
                'color' => $content->options->color,
                'size' => $content->options->size,
                'qty' => $content->qty,
                'singleprice' => $content->price,
                'totalprice' => $content->qty * $content->price,
            ]);
        }
        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notifiction =  array(
            'message' => 'process completed',
            'alert-type' => 'success'
        );
        return Redirect()->to('/')->with($notifiction);
    }
}
