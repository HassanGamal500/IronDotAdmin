<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminServiceController extends Controller
{
    public function index(){
        $services = DB::table('services')
            ->join('service_descriptions', 'service_descriptions.service_id', '=', 'services.service_id')
            ->select('services.service_id as id', 'service_image as image', 'service_name as name', 'service_short_content as content', 'active')
            ->where('service_descriptions.language_id', '=', language())
            ->orderBy('services.service_id', 'desc')
            ->get();
        return view('admin_panel.service.index', compact('services'));
    }

    public function adminCreate(){
        return view('admin_panel.service.create');
    }

    public function adminStore(Request $request){
        $validator = validator()->make($request->all(), [
            'service_name' => 'required|max:100',
            'service_short_content' => 'required',
            'service_image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        if(preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->service_name[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->service_short_content[2])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->service_name[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->service_short_content[1]))
        {
            if ($request->hasFile('service_image')) {
                $service_image = Storage::disk('edit_path')->putFile('images/service', $request->file('service_image'));
            } else {
                $service_image = 'images/service/avatar_service.png';
            }

            $service = DB::table('services')
                ->insertGetId([
                    'service_image' => $service_image
                ]);

            for ($i = 1; $i <= 2; $i++){
                $portfolio_description = DB::table('service_descriptions')
                    ->insert([
                        'service_name' => $request->service_name[$i],
                        'service_short_content'=> $request->service_short_content[$i],
                        'language_id' => $i,
                        'service_id' => $service
                    ]);
            }
        } else {
            if(!preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->service_name[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->service_short_content[2])) {
                $error = trans('admin.name or content must be contain only english characters');
            } else {
                $error = trans('admin.name or content must be contain only arabic characters');
            }
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminEdit($id){
    	$services = DB::table('services')
            ->join('service_descriptions', 'service_descriptions.service_id', '=', 'services.service_id')
            ->select('services.service_id as id', 'service_image', 'service_name', 'service_short_content')
            ->where('services.service_id', '=', $id)
            ->orderBy('services.service_id', 'desc')
            ->get();

        return view('admin_panel.service.edit', compact('services'));
    }

    public function adminUpdate(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'service_name' => 'required|max:100',
            'service_short_content' => 'required',
            'service_image' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        if(preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->service_name[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->service_short_content[2])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->service_name[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->service_short_content[1]))
        {
            if ($request->hasFile('service_image')) {
                $getImage = DB::table('services')->where('service_id', '=', $id)->select('service_image')->first();
                if($getImage->service_image != 'images/service/avatar_service.png'){
                    $myFile = base_path($getImage->service_image);
                    File::delete($myFile);
                }
                $service_image = Storage::disk('edit_path')->putFile('images/service', $request->file('service_image'));
            } else {
                $service_image = $request->old_service_image;
            }

            $items = DB::table('services')
                ->where('service_id', '=', $id)
                ->update([
                    'service_image' => $service_image
                ]);

            for ($i = 1; $i <= 2; $i++){
                $description = DB::table('service_descriptions')
                    ->where('service_id', '=', $id)
                    ->where('language_id', '=', $i)
                    ->update([
                        'service_name' => $request->service_name[$i],
                        'service_short_content'=> $request->service_short_content[$i]
                    ]);
            }
        } else {
            if(!preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->service_name[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->service_short_content[2])) {
                $error = trans('admin.name or content must be contain only english characters');
            } else {
                $error = trans('admin.name or content must be contain only arabic characters');
            }
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

            

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminDestroy($id){
    	$getImage = DB::table('services')->where('service_id', '=', $id)->select('service_image')->first();
        if($getImage->service_image != 'images/service/avatar_service.png'){
            $myFile = base_path($getImage->service_image);
            File::delete($myFile);
        }
        $product = DB::table('services')
            ->where('service_id', '=', $id)
            ->delete();
    }
}
