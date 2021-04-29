<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\Setting;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart($id)
    {
        if (!Auth::check()) {

            return response()->json(['error' => 'please login']);
        }
        $product = Product::find($id);
        $price = $product->price;
        if ($product->discount != Null) {
            $price = $product->price - ($product->price * ($product->discount / 100));
        }
        $data = [];
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = 1;
        $data['price'] = $price;
        $data['weight'] = 1;
        $data['options']['size'] = "";
        $data['options']['color'] = "";
        $data['options']['image'] = $product->image_one;
        Cart::add($data);
        return response()->json(['success' => 'Added to your cart']);
    }

    public function showCart()
    {
        $carts = Cart::content();
        return view('web.cart.cartIndex', compact('carts'));
    }

    public function removeFromCart($rowId)
    {
        Cart::remove($rowId);
        $notification = [
            'message' => 'deleted from cart',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }



    public function updateCart(Request $request)
    {
        $rowId = $request->product_id;
        $qty = $request->qty;

        Cart::update($rowId, $qty);
        $notification = [
            'message' => 'cart updated',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function viewModalCart($id)
    {

        $product = Product::findOrFail($id);
        $product_cat =  $product->category;
        $product_subcat =  $product->subcat;
        $product_brand =  $product->brand;
        $product_image_one =  $product->image_one;

        $color = explode(',', $product->color);
        $size = explode(',', $product->size);

        return response()->json([
            'product' => $product,
            'color' => $color,
            'size' => $size,
            'product_cat' => $product_cat,
            'product_subcat' => $product_subcat,
            'product_brand' => $product_brand,
            'product_image_one' => $product_image_one,
        ]);
    }

    public function insertModalCartData(Request $request)
    {
        if (!Auth::check()) {

            $notifiction =  array(
                'message' => 'please login first ',
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with($notifiction);
        }

        $id = $request->productIid;
        $product = Product::findOrFail($id);

        $price = $product->price;
        if ($product->discount != Null) {
            $price = $product->price - ($product->price * ($product->discount / 100));
        }

        $data = [];
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = $request->qty;
        $data['price'] = $price;
        $data['weight'] = 1;
        $data['options']['size'] = $request->productSize;
        $data['options']['color'] = $request->productColor;
        $data['options']['image'] = $product->image_one;
        Cart::add($data);
        $notification = [
            'message' => 'added to cart',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function checkout()
    {
        if (!auth()->check()) {
            $notification = [
                'message' => 'login',
                'alert-type' => 'info',
            ];
            return redirect()->route('login')->with($notification);
        }

        $carts = Cart::content();
        $setting = Setting::first();
        return view('web.cart.checkout', compact('carts', 'setting'));
    }

    public function wishlist()
    {
        $wishlists = WishList::get();
        return view('web.cart.wishlist', compact('wishlists'));
    }

    public function applyCoupon(Request $request)
    {
        $coupon_code = $request->coupon_code;

        $check = DB::table('coupons')->where('coupon', $coupon_code)->first();
        if ($check) {
            Session::put('coupon', [
                'name'   => $check->coupon,
                'discount' => $check->discount,
                //   'balance'  => Cart::subtotal() - $check->discount,
            ]);
            $notification = [
                'message' => 'Successfully Coupon Applied',
                'alert-type' => 'info',
            ];
            return redirect()->back()->with($notification);
        }

        $notification = [
            'message' => 'Invalid Coupon',
            'alert-type' => 'error',
        ];
        return redirect()->back()->with($notification);
    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        $notification = [
            'message' => 'Coupon Removed',
            'alert-type' => 'warning',
        ];
        return redirect()->back()->with($notification);
    }
}
