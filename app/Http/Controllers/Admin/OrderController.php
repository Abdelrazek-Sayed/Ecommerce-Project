<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{



    public function pendingOrders()
    {
        $orders = Order::where('status', 0)->get();
        return  view('admin.order.pending', compact('orders'));
    }

    public function acceptedOrders()
    {
        $orders = Order::where('status', 1)->get();
        return  view('admin.order.accepted', compact('orders'));
    }
    public function cancelledOrders()
    {
        $orders = Order::where('status', 5)->get();
        return  view('admin.order.cancelled', compact('orders'));
    }
    public function indeliveryOrders()
    {
        $orders = Order::where('status', 2)->get();
        return  view('admin.order.indelivery', compact('orders'));
    }
    public function successOrders()
    {
        $orders = Order::where('status', 3)->get();
        return  view('admin.order.success', compact('orders'));
    }

    public function viewOrder($id)
    {
        $order = Order::findOrfail($id);
        $shipping = Shipping::where('oredr_id', $id)->first();
        //  $details = OrderDetail::where('order_id', $id)->first();

        $details = DB::table('order_details')
            ->join('products', 'order_details.product_id', 'products.id')
            ->select('order_details.*', 'products.code', 'products.image_one')
            ->where('order_details.order_id', $id)->get();

        return view('admin.order.order', compact('order', 'shipping', 'details'));
    }

    public function acceptOrder($id)
    {
        $order = Order::findOrfail($id);


        $order->update([
            'status' => 1,
        ]);

        $notifiction =  array(
            'message' => 'Order accepted',
            'alert-type' => 'success'
        );
        return back()->with($notifiction);
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrfail($id);
        $order->update([
            'status' => 5,
        ]);

        $notifiction =  array(
            'message' => 'Order Cancelled',
            'alert-type' => 'error'
        );
        return Redirect()->route('cancelled.orders')->with($notifiction);
    }



    public function processDelivery($id)
    {
        $order = Order::findOrfail($id);
        $order->update([
            'status' => 2,
        ]);

        $notifiction =  array(
            'message' => 'Order Done',
            'alert-type' => 'success'
        );
        return back()->with($notifiction);
    }


    public function deliveryDone($id)
    {
        $order = Order::findOrfail($id);
        //   $order_qty = $order->details->qty;

        $order->update([
            'status' => 3,
        ]);

        $notifiction =  array(
            'message' => 'Order delivery  Done',
            'alert-type' => 'success'
        );
        return Redirect()->route('success.orders')->with($notifiction);
    }

    public function retuenRequest()
    {
        $orders = Order::where([['return_order', 1]])->get();
        return view('admin.order.return', compact('orders'));
    }

    public function acceptReturn($id)
    {
        $order = Order::findOrfail($id);
        $order->update([
            'return_order' => 2,
        ]);
        $notifiction =  array(
            'message' => 'Return Done',
            'alert-type' => 'success'
        );
        return back()->with($notifiction);
    }

    public function allRequests()
    {
        $orders = Order::whereIn('return_order', [2])->get();
        return view('admin.order.allreturn', compact('orders'));
    }
}
