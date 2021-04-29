<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allCoupons()
    {
        $coupons = DB::table('coupons')->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function storeCoupons(Request $request)
    {
        $request->validate([
            'coupon' => 'required',
            'discount' => 'required',
        ]);

        DB::table('coupons')->insert([
            'coupon' => $request->coupon,
            'discount' => $request->discount,
        ]);

        $notifiction =  array(
            'message' => 'Coupon created',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notifiction);
    }


    public function editCoupons($id)
    {

        $coupon =  DB::table('coupons')->where('id', $id)->first();
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function updateCoupons(Request $request,$id)
    {
        $request->validate([
            'coupon' => 'required',
            'discount' => 'required',
        ]);

        $coupon =  DB::table('coupons')->where('id', $id)->update([
            'coupon' => $request->coupon,
            'discount' => $request->discount,
        ]);

            $notifiction =  array(
                'message' => 'coupon Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.coupon')->with($notifiction);

    }


    public function deleteCoupons($id)
    {

        DB::table('coupons')->where('id', $id)->delete();
        $notifiction =  array(
            'message' => 'Coupon deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notifiction);
    }
}
