<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminAboutController extends Controller
{

	public function adminEdit(){
    	$about = DB::table('about_us')
            ->join('about_us_descriptions', 'about_us_descriptions.about_us_id', '=', 'about_us.about_us_id')
            ->select('about_us.about_us_id as id', 'about_us_image', 'about_us_message_image', 'president_image',
	        'about_us_title', 'about_us_short_content', 'about_us_content', 'about_us_goals_content', 
	        'about_us_vision_content', 'about_us_partner_short_content')
            ->orderBy('about_us.about_us_id', 'desc')
            ->where('about_us.about_us_id', '=', 1)
            ->get();

        return view('admin_panel.about.edit', compact('about'));
    }

    public function adminUpdate(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'about_us_title' => 'required|max:100',
            'about_us_short_content' => 'required|max:300',
            'about_us_content' => 'required',
            'about_us_goals_content' => 'required',
            'about_us_vision_content' => 'required',
            'about_us_partner_short_content' => 'required|max:300',
            'about_us_image' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
            'about_us_message_image' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
            'president_image' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        if(preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->about_us_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->about_us_short_content[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->about_us_content[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->about_us_goals_content[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->about_us_vision_content[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->about_us_partner_short_content[2])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->about_us_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->about_us_short_content[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->about_us_content[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->about_us_goals_content[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->about_us_vision_content[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->about_us_partner_short_content[1])) 
        {
            if ($request->hasFile('about_us_image')) {
                $getImage = DB::table('about_us')->where('about_us_id', '=', 1)->select('about_us_image')->first();
                $myFile = base_path($getImage->about_us_image);
                File::delete($myFile);
                $about_us_image = Storage::disk('edit_path')->putFile('images/about', $request->file('about_us_image'));
            } else {
                $about_us_image = $request->old_about_us_image;
            }

            if ($request->hasFile('about_us_message_image')) {
                $getImage = DB::table('about_us')->where('about_us_id', '=', 1)->select('about_us_message_image')->first();
                $myFile = base_path($getImage->about_us_message_image);
                File::delete($myFile);
                $about_us_message_image = Storage::disk('edit_path')->putFile('images/about', $request->file('about_us_message_image'));
            } else {
                $about_us_message_image = $request->old_about_us_message_image;
            }

            if ($request->hasFile('president_image')) {
                $getImage = DB::table('about_us')->where('about_us_id', '=', 1)->select('president_image')->first();
                $myFile = base_path($getImage->president_image);
                File::delete($myFile);
                $president_image = Storage::disk('edit_path')->putFile('images/about', $request->file('president_image'));
            } else {
                $president_image = $request->old_president_image;
            }

            $items = DB::table('about_us')
                ->where('about_us_id', '=', 1)
                ->update([
                    'about_us_image' => $about_us_image,
                    'about_us_message_image' => $about_us_message_image,
                    'president_image' => $president_image
                ]);

            for ($i = 1; $i <= 2; $i++){
                $description = DB::table('about_us_descriptions')
                    ->where('about_us_id', '=', 1)
                    ->where('language_id', '=', $i)
                    ->update([
                        'about_us_title' => $request->about_us_title[$i],
                        'about_us_short_content' => $request->about_us_short_content[$i],
                        'about_us_content'=> $request->about_us_content[$i],
                        'about_us_goals_content'=> $request->about_us_goals_content[$i],
                        'about_us_vision_content'=> $request->about_us_vision_content[$i],
                        'about_us_partner_short_content'=> $request->about_us_partner_short_content[$i]
                    ]);
            }
        } else {
            if(!preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->about_us_title[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->about_us_short_content[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->about_us_content[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->about_us_goals_content[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->about_us_vision_content[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->about_us_partner_short_content[2])) {
                $error = trans('admin.name or title or content must be contain only english characters');
            } else {
                $error = trans('admin.name or title or content must be contain only arabic characters');
            }
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

}
