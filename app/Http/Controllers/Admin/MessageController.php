<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactResponse;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function  Messages()
    {
        $msgs = Contact::get();
        return view('admin.contact.allmessages', compact('msgs'));
    }

    public function showMessage($id)
    {
        $message = Contact::findOrFail($id);
        return view('admin.contact.message', compact('message'));
    }

    public function deleteMessage($id)
    {
        $msg = Contact::findOrFail($id)->delete();


        $notifiction =  array(
            'message' => 'Message Deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notifiction);
    }


    public function responseMessage($id, Request $request)
    {

        $request->validate([

            'title' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
        ]);

        $message = Contact::findOrFail($id);

        $name = $message->name;
        $email = $message->email;

        $title =  $request->title;
        $body =  $request->body;

        Mail::to($email)->send(new ContactResponse($name, $title, $body));


        $notifiction =  array(
            'message' => 'Response Sent',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notifiction);
    }
}
