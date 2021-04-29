<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MainAdminController extends Controller
{
    public function adminProfile()
    {
        $id = auth('admin')->id();
        $admin = Admin::findOrFail($id);
        // $admin = Admin::find(1);
        return view('admin.profile.adminProfile', compact('admin'));
    }


    public function editProfile()
    {
        $id = auth('admin')->id();
        $admin = Admin::findOrFail($id);
        // $admin = Admin::findOrFail(1);
        return view('admin.profile.edit', compact('admin'));
    }

    public function  updateProfile(Request $request)
    {

        $id = auth('admin')->id();
        $admin = Admin::findOrFail($id);
        // $admin = Admin::findOrFail(1);

        $path = $admin->profile_photo_path;

        if ($request->hasFile('profile_photo_path')) {
            Storage::delete($path);
            $path = Storage::putFile('adminImages', $request->file('profile_photo_path'));
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->profile_photo_path = $path;
        $admin->save();

        $notifiction =  array(
            'message' => 'admin  profile updated',
            'alert-type' => 'warning'
        );
        return Redirect()->route('admin.profile')->with($notifiction);
    }

    public function  editaPassword()
    {
        $id = Auth::guard('admin')->id();
        $admin = Admin::findOrFail($id);
        return view('admin.password.edit', compact('admin'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $adminPassword = Auth::guard('admin')->user()->password;

        $current_password = $request->oldpassword;
        if (Hash::check($current_password, $adminPassword)) {
            $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
            $admin->update([
                'password' => Hash::make($request->password),
            ]);

            Auth::logout();

            return redirect()->route('admin.logout');
        } else {
            $notifiction =  array(
                'message' => 'admin password do not updated',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notifiction);
        }
    }
}
