<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminTeamController extends Controller
{
    public function index(){
        $teams = DB::table('teams')
            ->select('teams_id as id', 'teams_name as name', 'teams_position as position', 'teams_image as image', 'active')
            ->orderBy('teams_id', 'desc')
            ->get();
        return view('admin_panel.team.index', compact('teams'));
    }

    public function adminCreate(){
        return view('admin_panel.team.create');
    }

    public function adminStore(Request $request){
        $validator = validator()->make($request->all(), [
            'teams_name' => 'required|max:200',
            'teams_position' => 'required|max:200',
            'teams_fb' => 'required|max:200',
            'teams_tw' => 'required|max:200',
            'teams_in' => 'required|max:200',
            'teams_insta' => 'required|max:200',
            'teams_cover' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
            'teams_image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        if ($request->hasFile('teams_cover')) {
            $teams_cover = Storage::disk('edit_path')->putFile('images/team', $request->file('teams_cover'));
        } else {
            $teams_cover = 'images/team/avatar_team.png';
        }

        if ($request->hasFile('teams_image')) {
            $teams_image = Storage::disk('edit_path')->putFile('images/team', $request->file('teams_image'));
        } else {
            $teams_image = 'images/team/avatar_team.png';
        }

        $teams = DB::table('teams')
            ->insertGetId([
                'teams_name' => $request->teams_name,
                'teams_position' => $request->teams_position,
                'teams_fb' => $request->teams_fb,
                'teams_tw' => $request->teams_tw,
                'teams_in' => $request->teams_in,
                'teams_insta' => $request->teams_insta,
                'teams_cover' => $teams_cover,
                'teams_image' => $teams_image
            ]);

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminEdit($id){
    	$teams = DB::table('teams')
            ->select('teams_id as id', 'teams_name', 'teams_position', 'teams_image', 'teams_fb', 'teams_tw',
            	'teams_in', 'teams_insta', 'teams_cover')
            ->orderBy('teams_id', 'desc')
            ->where('teams_id', '=', $id)
            ->first();

        return view('admin_panel.team.edit', compact('teams'));
    }

    public function adminUpdate(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'teams_name' => 'required|max:200',
            'teams_position' => 'required|max:200',
            'teams_fb' => 'required|max:200',
            'teams_tw' => 'required|max:200',
            'teams_in' => 'required|max:200',
            'teams_insta' => 'required|max:200',
            'teams_cover' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
            'teams_image' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        if ($request->hasFile('teams_cover')) {
        	$getImage = DB::table('teams')->where('teams_id', '=', $id)->select('teams_cover')->first();
            if($getImage->teams_cover != 'images/team/avatar_team.png'){
                $myFile = base_path($getImage->teams_cover);
                File::delete($myFile);
            }
            $teams_cover = Storage::disk('edit_path')->putFile('images/team', $request->file('teams_cover'));
        } else {
            $teams_cover = $request->old_teams_cover;
        }

        if ($request->hasFile('teams_image')) {
        	$getImage = DB::table('teams')->where('teams_id', '=', $id)->select('teams_image')->first();
            if($getImage->teams_image != 'images/team/avatar_team.png'){
                $myFile = base_path($getImage->teams_image);
                File::delete($myFile);
            }
            $teams_image = Storage::disk('edit_path')->putFile('images/team', $request->file('teams_image'));
        } else {
            $teams_image = $request->old_teams_image;
        }

        $items = DB::table('teams')
            ->where('teams_id', '=', $id)
            ->update([
                'teams_name' => $request->teams_name,
                'teams_position' => $request->teams_position,
                'teams_fb' => $request->teams_fb,
                'teams_tw' => $request->teams_tw,
                'teams_in' => $request->teams_in,
                'teams_insta' => $request->teams_insta,
                'teams_cover' => $teams_cover,
                'teams_image' => $teams_image
            ]);

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminDestroy($id){
    	$getImageFirst = DB::table('teams')->where('teams_id', '=', $id)->select('teams_cover')->first();
        if($getImageFirst->teams_cover != 'images/team/avatar_team.png'){
            $myFile = base_path($getImageFirst->teams_cover);
            File::delete($myFile);
        }
        $getImageSecond = DB::table('teams')->where('teams_id', '=', $id)->select('teams_image')->first();
        if($getImageSecond->teams_image != 'images/team/avatar_team.png'){
            $myFile = base_path($getImageSecond->teams_image);
            File::delete($myFile);
        }
        $product = DB::table('teams')
            ->where('teams_id', '=', $id)
            ->delete();
    }
}
