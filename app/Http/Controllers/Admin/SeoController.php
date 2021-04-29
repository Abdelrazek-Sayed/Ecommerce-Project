<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function viewSeo()
    {
        $id = 1;
        $seo = Seo::findOrFail($id);
        //  $seo = Seo::first();
        return view('admin.seo.seo', compact('seo'));
    }

    public function updateSeo(Request $request ,$id)
    {
        $seo = Seo::findOrFail($id);

        $seo->update([
            'meta_title' => $request->meta_title,
            'meta_auther' => $request->meta_auther,
            'meta_tag' => $request->meta_tag,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,
            'bing_analytics' => $request->bing_analytics,
        ]);

        $notifiction =  array(
            'message' => 'Seo Updated',
            'alert-type' => 'success'
        );
        return back()->with($notifiction);
    }
}
