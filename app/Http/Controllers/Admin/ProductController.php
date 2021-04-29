<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allProduct()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    public function addProduct()
    {
        $cats = Category::get();
        $brands = Brand::get();
        // $subcats = SubCategory::get();
        return view('admin.product.create', compact('cats', 'brands'));
    }

    public function getSubCat($category_id)
    {
        $subcats = DB::table('sub_categories')->where('category_id', $category_id)->get();
        // $subcats = SubCategory::findOrFail($category_id);
        return json_encode($subcats);
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' =>  'required',
            'code' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'size' => 'nullable',
            'color' => 'nullable',
            'price' => 'required',
            'details' => 'nullable',
            'video_link' => 'nullable',
            'discount' => 'nullable',
            'main_slider' => 'nullable',
            'mid_slider' => 'nullable',
            'hot_deal' => 'nullable',
            'trend' => 'nullable',
            'buyone_getone' => 'nullable',

            'hot_new' => 'nullable',
            'best_rated' => 'nullable',
            'image_one' => 'nullable',
            'image_two' => 'nullable',
            'image_three' => 'nullable',
        ]);

        // if ($request->hasFile('image_one')) {
        //     $image_one_resize = Image::make($request->image_one->getRealPath())->resize(300, 300);
        //     $path_1 = $image_one_resize->save(public_path('uploads\adminImages\product' . $request->image_one->getClientOriginalName()));
        // }
        // if ($request->hasFile('image_two')) {
        //     $image_two_resize = Image::make($request->image_two->getRealPath())->resize(200, 200);
        //     $path_2 = $image_two_resize->save(public_path('uploads\adminImages\product' . $request->image_two->getClientOriginalName()));
        // }
        // if ($request->hasFile('image_three')) {
        //     $image_three_resize = Image::make($request->image_three->getRealPath())->resize(100, 100);
        //     $path_3 = $image_three_resize->save(public_path('uploads\adminImages\product' . $request->image_three->getClientOriginalName()));
        // }
        $path_1 = Storage::putFile('adminImages/product', $request->file('image_one'));
        $path_2 = Storage::putFile('adminImages/product', $request->file('image_two'));
        $path_3 = Storage::putFile('adminImages/product', $request->file('image_three'));



        Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'size' => $request->size,
            'color' => $request->color,
            'price' => $request->price,
            'details' => $request->details,
            'video_link' => $request->video_link,
            'discount' => $request->discount,
            'main_slider' => $request->main_slider,
            'mid_slider' => $request->mid_slider,
            'hot_deal' => $request->hot_deal,
            'trend' => $request->trend,
            'buyone_getone' => $request->buyone_getone,
            'hot_new' => $request->hot_new,
            'best_rated' => $request->best_rated,
            'image_one' => $path_1,
            'image_two' => $path_2,
            'image_three' => $path_3,
        ]);

        $notifiction =  array(
            'message' => 'Product Created',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.product')->with($notifiction);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $path_1 = $product->image_one;
        $path_2 = $product->image_two;
        $path_3 = $product->image_three;

        Storage::delete($path_1);
        Storage::delete($path_2);
        Storage::delete($path_3);

        $product->delete();
        $notifiction =  array(
            'message' => 'Product Deleted',
            'alert-type' => 'error'
        );
        return back()->with($notifiction);
    }

    public function toggleProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'status' => !$product->status,
        ]);

        $notifiction =  array(
            'message' => 'Status Changed',
            'alert-type' => 'error'
        );
        return back()->with($notifiction);
    }


    public function showproduct($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.product.show', compact('product'));
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $cats = Category::get();
        $subcats = SubCategory::get();
        $brands = Brand::get();
        return view('admin.product.edit', compact('product', 'cats', 'brands', 'subcats'));
    }

    public function updateProductWithoutPhoto(Request $request, $id)
    {
        $request->validate([
            'name' =>  'required',
            'code' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'size' => 'nullable',
            'color' => 'required',
            'price' => 'required',
            'details' => 'nullable',
            'video_link' => 'nullable',
            'discount' => 'nullable',
            'main_slider' => 'nullable',
            'mid_slider' => 'nullable',
            'hot_deal' => 'nullable',
            'trend' => 'nullable',
            'buyone_getone' => 'nullable',
            'hot_new' => 'nullable',
            'best_rated' => 'nullable',
        ]);
        $product = Product::findOrFail($id);


        $update =  $product->update([
            'name' => $request->name,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'size' => $request->size,
            'color' => $request->color,
            'price' => $request->price,
            'details' => $request->details,
            'video_link' => $request->video_link,
            'main_slider' => $request->main_slider,
            'mid_slider' => $request->mid_slider,
            'hot_deal' => $request->hot_deal,
            'trend' => $request->trend,
            'buyone_getone' => $request->buyone_getone,
            'hot_new' => $request->hot_new,
            'best_rated' => $request->best_rated,

        ]);

        if ($update) {
            $notifiction =  array(
                'message' => 'Product Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.product')->with($notifiction);
        } else {
            $notifiction =  array(
                'message' => 'No thing to update',
                'alert-type' => 'success'
            );
            return back()->with($notifiction);
        }
    }

    public function updateProductPhoto(Request $request, $id)
    {
        $request->validate([
            'image_one' => 'nullable',
            'image_two' => 'nullable',
            'image_three' => 'nullable',
        ]);

        $product = Product::findOrFail($id);

        $path_1 = $product->image_one;
        $path_2 = $product->image_two;
        $path_3 = $product->image_three;

        if ($request->hasFile('image_one')) {
            Storage::delete($path_1);
            $path_1 = Storage::putFile('adminImages/product', $request->file('image_one'));

            $update_image_one =   $product->update([
                'image_one' => $path_1,
            ]);

            if ($update_image_one) {
                $notifiction =  array(
                    'message' => 'Image one updated  ',
                    'alert-type' => 'success'
                );
                return Redirect()->route('all.product')->with($notifiction);
            }
        }
        if ($request->hasFile('image_two')) {
            Storage::delete($path_2);
            $path_2 = Storage::putFile('adminImages/product', $request->file('image_two'));

            $update_image_two =   $product->update([
                'image_two' => $path_2,
            ]);

            if ($update_image_two) {
                $notifiction =  array(
                    'message' => 'Image two updated  ',
                    'alert-type' => 'success'
                );
                return Redirect()->route('all.product')->with($notifiction);
            }
        }
        if ($request->hasFile('image_three')) {
            Storage::delete($path_3);
            $path_3 = Storage::putFile('adminImages/product', $request->file('image_three'));

            $update_image_three =   $product->update([
                'image_three' => $path_3,
            ]);

            if ($update_image_three) {
                $notifiction =  array(
                    'message' => 'Image three updated ',
                    'alert-type' => 'success'
                );
                return Redirect()->route('all.product')->with($notifiction);
            }
        }
    }
    public function Stock()
    {
        $products = Product::get();
        return view('admin.product.stock', compact('products'));
    }
}
