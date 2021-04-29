<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function allCats()
    {
        $cats =  Category::latest()->paginate(10);
        return view('admin.category.index', compact('cats'));
    }

    public function storeCat(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:categories|max:255',

            ],
            [
                'name.unique' => 'name is exist',
            ]
        );

        Category::create([
            'name' => $request->name,
        ]);

        $notifiction =  array(
            'message' => 'Category created',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notifiction);
    }


    public function editCat($id)
    {

        $cat = Category::findOrFail($id);
        return view('admin.category.edit', compact('cat'));
    }

    public function updateCat(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:categories|max:255',

            ]
        );
        $cat = Category::findOrFail($request->id);

        $update =   $cat->update([
            'name' => $request->name,
        ]);
        if ($update) {
            $notifiction =  array(
                'message' => 'Category Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.cat')->with($notifiction);
        } else {

            $notifiction =  array(
                'message' => 'Nothing To Updated',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notifiction);
        }
    }


    public function deleteCat($id)
    {

        $cat = Category::findOrFail($id)->delete();
        $notifiction =  array(
            'message' => 'Category deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notifiction);
    }

}
