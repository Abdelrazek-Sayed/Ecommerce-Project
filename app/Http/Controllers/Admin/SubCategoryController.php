<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allSubCats()
    {
        $cats = Category::latest()->get();

        // query builder and join
        // $subcats = DB::table('sub_categories')->join('categories', 'sub_categories.category_id', 'categories.id')
        //     ->select('sub_categories.*', 'categories.name As catName')->get();

        //relation
        $subcats = SubCategory::latest()->get();

        return view('admin.subcategory.index', compact('cats', 'subcats'));
    }

    public function storeSubCat(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);

        $notification = [
            'message' => 'subcategory created',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.subcat')->with($notification);
    }

    public function editSubCat($id)
    {
        $cats = Category::latest()->get();
        $subcat =  SubCategory::findOrFail($id);
        return view('admin.subcategory.edit',  compact('cats', 'subcat'));
    }


    public function updateSubCat(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:sub_categories|max:255',
                'category_id' => 'required',
            ]
        );
        $subcat = SubCategory::findOrFail($request->id);

        $update =   $subcat->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);
        if ($update) {
            $notifiction =  array(
                'message' => 'SubCategory Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.subcat')->with($notifiction);
        } else {

            $notifiction =  array(
                'message' => 'Nothing To Updated',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notifiction);
        }
    }
    public function deleteSubCat($id)
    {
        SubCategory::findOrFail($id)->delete();

        $notification = [
            'message' => 'subcategory created',
            'alert-type' => 'error',
        ];
        return back()->with($notification);
    }
}
