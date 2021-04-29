<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function  todayOrder()
    {
        $today = date('d-m-y');
        $orders = Order::where([['status', 0], ['date', $today]])->get();
        return view('admin.report.todayorder', compact('orders'));
    }


    public function  todayDelivery()
    {
        $today = date('d-m-y');
        $orders = Order::where([['status', 3], ['date', $today]])->get();
        return view('admin.report.todaydelivery', compact('orders'));
    }

    public function thisMonth()
    {
        $month = date('F');
        $orders = Order::where([['status', 3], ['month', $month]])->get();
        return view('admin.report.thismonth', compact('orders'));
    }

    public function search()
    {
        return view('admin.report.search');
    }

    public function searchYear(Request $request)
    {
        $year = $request->year;
        $sumtotal = Order::where([['status', 3], ['year', $year]])->sum('total');
        $orders = Order::where([['status', 3], ['year', $year]])->get();
        return view('admin.report.search_year', compact('orders', 'sumtotal'));
    }

    public function searchMonth(Request $request)
    {
        $month = $request->month;
        $sumtotal = Order::where([['status', 3], ['month', $month]])->sum('total');
        $orders = Order::where([['status', 3], ['month', $month]])->get();
        return view('admin.report.search_month', compact('orders', 'sumtotal'));
    }

    public function searchDate(Request $request)
    {
        $date = $request->date;

        $newdate = date('d-m-y', strtotime($date));
        $sumtotal = Order::where([['status', 3], ['date', $newdate]])->sum('total');
        $orders = Order::where([['status', 3], ['date', $newdate]])->get();
        return view('admin.report.search_date', compact('orders', 'sumtotal'));
    }
}
