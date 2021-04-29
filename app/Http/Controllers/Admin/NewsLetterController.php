<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allNewsLetter()
    {
        $newsletters = NewsLetter::get();
        return view('admin.newsletter.index', compact('newsletters'));
    }
    public function deleteNewsLetter($id)
    {

        NewsLetter::findOrFail($id)->delete();
        $notifiction =  array(
            'message' => 'Person deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notifiction);
    }


    public function deleteSelected(Request $request)
    {
        $ids =  $request->get('ids');
        DB::delete('delete from news_letters where id in(' . implode(',', $ids) . ')');

        $notifiction =  array(
            'message' => 'All Selected deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notifiction);
    }
}
