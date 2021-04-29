<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeIndexController extends Controller
{
    public function adminHome()
    {
        $date = date('d-m-y');
        $today = Order::where('date', $date)->sum('total');
        $month = date('F');
        $thismonth = Order::where('month', $month)->sum('total');
        $year = date('Y');
        $thisyear = Order::where('year', $year)->sum('total');

        $delivery = Order::where([['date', $date], ['status', 3]])->sum('total');

        $users = User::get();
        $products = Product::get();
        $returns = Order::where([['year', $year], ['return_order', 2]])->get();
        $orders = Order::get();

        $data = [];
        $data['today'] = $today;
        $data['thismonth'] = $thismonth;
        $data['thisyear'] = $thisyear;
        $data['delivery'] = $delivery;
        $data['users'] = $users;
        $data['products'] = $products;
        $data['returns'] = $returns;
        $data['orders'] = $orders;
        return view('admin.index')->with($data);
    }
}
