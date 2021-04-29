<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addwishlist($id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'please login ']);

        }
        $product_id = Product::findOrFail($id)->id;
        $user_id = auth()->id();
        $check  = WishList::where([['product_id', $product_id], ['user_id', $user_id]])->first();
        if ($check) {
            $check->delete();
            return response()->json(['success' => 'removed from favorit']);
        }
        WishList::create([
            'product_id' => $product_id,
            'user_id' => $user_id,
        ]);
        return response()->json(['success' => 'added to favorit']);
    }
}
