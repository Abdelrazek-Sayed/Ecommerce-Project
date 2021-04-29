<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductController extends Controller
{

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        $products  = Product::latest()->take(10)->get();

        $colors = explode(',', $product->color);
        $sizes = explode(',', $product->size);
        return view('web.product.details', compact('product', 'products', 'colors', 'sizes'));
    }


    public function addToCart(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'please login ']);
        }
        $product = Product::find($id);
        $data = [];

        $price = $product->price;
        if ($product->discount != Null) {
            $price = $product->price - ($product->price * ($product->discount / 100));
        }

        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = $request->qty;
        $data['price'] = $price;
        $data['weight'] = 1;
        $data['options']['size'] = $request->size;
        $data['options']['color'] = $request->color;
        $data['options']['image'] = $product->image_one;
        Cart::add($data);
        $notification = [
            'message' => 'added to cart',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }


    public function Cat($id)
    {
        $cats  = Category::get();
        $cat  = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();
        $brands =  Product::where('category_id', $id)->select('brand_id')->groupBy('brand_id')->get();
        return view('web.product.cat', compact('products', 'cat', 'brands', 'cats'));
    }

    public function Subcat($id)
    {
        $products = Product::where('subcategory_id', $id)->get();
        $subcat  = SubCategory::findOrFail($id);
        $cats  = Category::get();
        $brands =  Product::where('subcategory_id', $id)->select('brand_id')->groupBy('brand_id')->get();
        return view('web.product.subcat', compact('cats', 'subcat', 'products', 'brands'));
    }

    public function productSearch(Request $request)
    {
        $cats  = Category::get();
        $brands =  brand::get();

        $item = $request->search;
        $products = Product::where('name', 'LIKE', "%$item%")->get();
        return view('web.product.search', compact('products', 'cats', 'brands'));
    }
}
