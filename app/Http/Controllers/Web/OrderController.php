<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function viewOrder($id)
    {
        $order = Order::findOrfail($id);
        $shipping = Shipping::where('oredr_id', $id)->first();


        $details = DB::table('order_details')
            ->join('products', 'order_details.product_id', 'products.id')
            ->select('order_details.*', 'products.code', 'products.image_one')
            ->where('order_details.order_id', $id)->get();

        return view('web.order.order', compact('order', 'shipping', 'details'));
    }
    public function trackOrder(Request $request)
    {
        $request->validate([
            'status_code' => 'required',
        ]);

        $order = Order::where('status_code', $request->status_code)->first();
        if ($order) {
            return view('web.order.tracking', compact('order'));
        } else {
            $notifiction =  array(
                'message' => 'Invalid Code',
                'alert-type' => 'erorr'
            );
            return back()->with($notifiction);
        }
    }

    public function listOrder()
    {
        $orders = Order::where([['user_id', auth()->id()]])->get();
        return view('web.order.list', compact('orders'));
    }

    public function returnOrder($id)
    {
        $order = Order::findOrfail($id);
        $order->update([
            'return_order' => 1,
        ]);

        $notifiction =  array(
            'message' => 'Done',
            'alert-type' => 'erorr'
        );
        return back()->with($notifiction);
    }
}
