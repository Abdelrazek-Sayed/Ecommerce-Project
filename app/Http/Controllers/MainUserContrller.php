<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MainUserContrller extends Controller
{
    public function logout()
    {
        Auth::logout();

        $notifiction =  array(
            'message' => 'You are logged out ',
            'alert-type' => 'success'
        );
        return redirect()->route('login')->with($notifiction);
    }

    // public function profile()
    // {
    //     $id = Auth::user()->id;
    //     // $id = Auth::id();
    //     $user = User::findOrFail($id);
    //     return view('user.index', compact('user'));
    // }


    public function editProfile()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        return view('user.edit-profile', compact('user'));
    }

    public function  updateProfile(Request $request)
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        $path = $user->image;

        if ($request->hasFile('image')) {
            Storage::delete($path);
            $path = Storage::putFile('userImages', $request->file('image'));
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $path;
        $user->save();

        $notifiction =  array(
            'message' => 'user profile updated',
            'alert-type' => 'warning'
        );
        return Redirect()->route('user.profile')->with($notifiction);
    }


    public function editPassword()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        return view('user.edit-password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $userPassword = Auth::user()->password;

        $current_password = $request->oldpassword;
        if (Hash::check($current_password, $userPassword)) {
            $user = User::findOrFail(Auth::user()->id);
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            Auth::logout();

            $notifiction =  array(
                'message' => 'password updated',
                'alert-type' => 'success'
            );
            return redirect()->route('login')->with($notifiction);;
        } else {
            $notifiction =  array(
                'message' => 'user password did not updated',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notifiction);
        }
    }
}
