<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allBrands()
    {
        $brands =  Brand::latest()->get();
        return view('admin.brand.index', compact('brands'));
    }

    public function storeBrand(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|unique:brands',
                'logo' => 'required',
            ],
            [
                'name.required' => 'enter barnd name',
                'logo.required' => 'enter barnd image',
            ]
        );

        $path = Storage::putFile('adminImages/brand', $request->file('logo'));

        Brand::create([
            'name' => $request->name,
            'logo' => $path,
        ]);

        $notifiction =  array(
            'message' => 'Brand created',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notifiction);
    }

    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function updateBrand(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'logo' => 'nullable',
            ],
            [
                'name.required' => 'enter barnd name',
                'logo.required' => 'enter barnd image',
            ]
        );
        $brand = Brand::findOrFail($id);
        $path = $brand->logo;

        if ($request->hasFile('logo')) {
            Storage::delete($path);
            $path = Storage::putFile('adminImages/brand', $request->file('logo'));
        }

        $update =   $brand->update([
            'name' => $request->name,
            'logo' => $path,
        ]);

        if ($update) {
            $notifiction =  array(
                'message' => 'Brand Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.brand')->with($notifiction);
        } else {

            $notifiction =  array(
                'message' => 'Nothing To Updated',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notifiction);
        }
    }


    public function deleteBrand($id)
    {

        $brand = Brand::findOrFail($id);
        $path = $brand->logo;
        Storage::delete($path);
        $brand->delete();
        $notifiction =  array(
            'message' => 'Brand deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notifiction);
    }
}
