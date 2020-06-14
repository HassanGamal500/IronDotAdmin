<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminPartnerController extends Controller
{
    public function index(){
        $partners = DB::table('partners')
            ->select('partner_id as id', 'partner_image as image', 'partner_link as link', 'active')
            ->orderBy('partner_id', 'desc')
            ->get();
        return view('admin_panel.partner.index', compact('partners'));
    }

    public function adminCreate(){
        return view('admin_panel.partner.create');
    }

    public function adminStore(Request $request){
        $validator = validator()->make($request->all(), [
            'partner_link' => 'nullable|max:300',
            'partner_image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        if ($request->hasFile('partner_image')) {
            $partner_image = Storage::disk('edit_path')->putFile('images/partner', $request->file('partner_image'));
        } else {
            $partner_image = 'images/partner/avatar_partner.png';
        }

        $partner = DB::table('partners')
            ->insertGetId([
            	'partner_link' => $request->partner_link,
                'partner_image' => $partner_image
            ]);

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminEdit($id){
    	$partners = DB::table('partners')
            ->select('partner_id as id', 'partner_image', 'partner_link')
            ->orderBy('partner_id', 'desc')
            ->where('partner_id', '=', $id)
            ->get();

        return view('admin_panel.partner.edit', compact('partners'));
    }

    public function adminUpdate(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'partner_link' => 'nullable|max:300',
            'partner_image' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        if ($request->hasFile('partner_image')) {
        	$getImage = DB::table('partners')->where('partner_id', '=', $id)->select('partner_image')->first();
            if($getImage->partner_image != 'images/partner/avatar_partner.png'){
                $myFile = base_path($getImage->partner_image);
                File::delete($myFile);
            }
            $partner_image = Storage::disk('edit_path')->putFile('images/partner', $request->file('partner_image'));
        } else {
            $partner_image = $request->old_partner_image;
        }

        $items = DB::table('partners')
            ->where('partner_id', '=', $id)
            ->update([
                'partner_link' => $request->partner_link,
                'partner_image' => $partner_image
            ]);

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminDestroy($id){
    	$getImage = DB::table('partners')->where('partner_id', '=', $id)->select('partner_image')->first();
        if($getImage->partner_image != 'images/partner/avatar_partner.png'){
            $myFile = base_path($getImage->partner_image);
            File::delete($myFile);
        }
        $product = DB::table('partners')
            ->where('partner_id', '=', $id)
            ->delete();
    }
}
