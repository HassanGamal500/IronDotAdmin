<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminSettingController extends Controller
{
    public function adminEdit(){
    	$setting = DB::table('settings')
            ->join('settings_descriptions', 'settings_descriptions.settings_id', '=', 'settings.settings_id')
            ->select('settings.settings_id as id', 'phone', 'fax', 'mail', 'contact_email', 'linked_in', 'youtube', 'facebook', 
	        'twitter', 'insta', 'whats_app', 'currency', 'address', 'footer_content')
            ->orderBy('settings.settings_id', 'desc')
            ->where('settings.settings_id', '=', 1)
            ->get();

        return view('admin_panel.setting.edit', compact('setting'));
    }

    public function adminUpdate(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'phone' => 'required|max:13',
            'fax' => 'required|max:20',
            'mail' => 'required|email',
            'contact_email' => 'required|email',
            'linked_in' => 'required',
            'youtube' => 'required|max:300',
            'facebook' => 'required',
            'twitter' => 'required',
            'insta' => 'required',
            'whats_app' => 'required',
            'currency' => 'required|max:300',
            'address' => 'required|max:500',
            'footer_content' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        $setting = DB::table('settings')
            ->where('settings_id', '=', 1)
            ->update([
                'phone' => $request->phone,
                'fax' => $request->fax,
                'mail' => $request->mail,
                'contact_email' => $request->contact_email,
                'linked_in' => $request->linked_in,
                'youtube' => $request->youtube,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'insta' => $request->insta,
                'whats_app' => $request->whats_app,
                'currency' => $request->currency
            ]);

        for ($i = 1; $i <= 2; $i++){
            $description = DB::table('settings_descriptions')
                ->where('settings_id', '=', 1)
                ->where('language_id', '=', $i)
                ->update([
                    'address' => $request->address[$i],
                    'footer_content' => $request->footer_content[$i]
                ]);
        }

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }
}
