<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function editSetting()
    {

        $setting = SiteSetting::first();
        return view('admin.setting.editsetting', compact('setting'));
    }

    public function updateSetting(Request $request)
    {
        $id = $request->setting_id;
        $setting = SiteSetting::findOrFail($id);

        $setting->update([
            'phone_one'       => $request->phone_one,
            'phone_two'       => $request->phone_two,
            'email'           => $request->email,
            'company_name'    => $request->company_name,
            'company_address' => $request->company_address,
            'facebook'         => $request->facebook,
            'youtube'          => $request->youtube,
            'twitter'          => $request->twitter,
            'instagram'        => $request->instagram,
        ]);
        $notification = [
            'message' => 'Setting updated',
            'alert-type' => 'success',
        ];
        return redirect()->route('edit.setting')->with($notification);
    }
}
