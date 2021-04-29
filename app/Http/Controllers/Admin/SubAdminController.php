<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubAdminController extends Controller
{
    public function allAdmin()
    {
        $admins = Admin::get();
        return view('admin.admins.allAdmin', compact('admins'));
    }

    public function addAdmin()
    {
        $roles = Role::get();
        return view('admin.admins.addAdmin', compact('roles'));
    }

    public function deleteAdmin($id)
    {

        Admin::findOrFail($id)->delete();


        $notification = [
            'message' => 'Admin Deleted',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.admin')->with($notification);
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required',
            'role' => 'required',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'data' => $request->data,
            'copoun' => $request->copoun,
            'newsletters' => $request->newsletter,
            'product' => $request->product,
            'blog' => $request->blog,
            'orders' => $request->orders,
            'others' => $request->other,
            'report' => $request->report,
            'comment' => $request->comment,
            'contact' => $request->contact,
            'setting' => $request->setting,
            'stock' => $request->stock,

        ]);
        $notification = [
            'message' => 'Admin created',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.admin')->with($notification);
    }

    public function editAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::get();
        return view('admin.admins.editAdmin', compact('admin', 'roles'));
    }

    public function updateAdmin($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);
        $admin = Admin::findOrFail($id);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'data' => $request->data,
            'copoun' => $request->copoun,
            'newsletters' => $request->newsletter,
            'product' => $request->product,
            'blog' => $request->blog,
            'orders' => $request->orders,
            'others' => $request->other,
            'report' => $request->report,
            'comment' => $request->comment,
            'contact' => $request->contact,
            'setting' => $request->setting,
            'stock' => $request->stock,
        ]);
        $notification = [
            'message' => 'Admin updated',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.admin')->with($notification);
    }
}
