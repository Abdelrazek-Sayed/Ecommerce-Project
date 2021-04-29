<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function storeNewsLetter(Request $request)
    {
      $subsripe =  $request->validate([
            'email' => 'required|email|unique:news_letters',
        ]);

        if(! $subsripe){

            $notifiction =  array(
                'message' => 'you already subscribed',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notifiction);
            }

        NewsLetter::create([
            'email' => $request->email,
        ]);

        $notifiction =  array(
            'message' => 'successsful subcription',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notifiction);


    }
}
