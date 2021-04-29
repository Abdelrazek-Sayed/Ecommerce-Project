<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{

    public function set($lang ,Request $request)
    {
        $acceptedLangs =['en','ar'];
        if (! in_array($lang,$acceptedLangs)){
            $lang = 'en' ;
        }

        Session::put('lang', $lang);
       // $request->session()->put('lang',$lang);
        return back();
    }
}
