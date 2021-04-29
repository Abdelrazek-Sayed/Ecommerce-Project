<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function ContactPage()
    {
        $setting = SiteSetting::first();
        return view('web.contact.page', compact('setting'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        $notification = [
            'message' => 'Message Sent successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
