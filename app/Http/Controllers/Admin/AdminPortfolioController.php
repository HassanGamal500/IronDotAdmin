<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminPortfolioController extends Controller
{
    public function index(){
        $portfolios = DB::table('portfolio')
            ->join('portfolio_descriptions', 'portfolio_descriptions.portfolio_id', '=', 'portfolio.portfolio_id')
            ->select('portfolio.portfolio_id as id', 'portfolio_image as image', 'portfolio_name as name', 'portfolio_title as title', 'active')
            ->where('portfolio_descriptions.language_id', '=', language())
            ->orderBy('portfolio.portfolio_id', 'desc')
            ->get();
        return view('admin_panel.portfolio.index', compact('portfolios'));
    }

    public function changeStatus(Request $request)
    {
        $active = DB::table($request->table);
        if($request->table == 'portfolio'){
            $active->where('portfolio_id', '=', $request->id)->update(['active' => $request->status]);
        } elseif($request->table == 'product') {
            $active->where('product_id', '=', $request->id)->update(['active' => $request->status]);
        } elseif($request->table == 'blog') {
            $active->where('blog_id', '=', $request->id)->update(['active' => $request->status]);
        } elseif($request->table == 'jobs') {
            $active->where('job_id', '=', $request->id)->update(['active' => $request->status]);
        } elseif($request->table == 'partners') {
            $active->where('partner_id', '=', $request->id)->update(['active' => $request->status]);
        } elseif($request->table == 'services') {
            $active->where('service_id', '=', $request->id)->update(['active' => $request->status]);
        } elseif($request->table == 'teams') {
            $active->where('teams_id', '=', $request->id)->update(['active' => $request->status]);
        }
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function adminCreate(){
        $services = DB::table('services')
        	->join('service_descriptions', 'service_descriptions.service_id', '=', 'services.service_id')
        	->select('services.service_id as id', 'service_name as name')
        	->where('language_id', '=', language())
        	->get();
        return view('admin_panel.portfolio.create', compact('services'));
    }

    public function adminStore(Request $request){
        $validator = validator()->make($request->all(), [
            'portfolio_name' => 'required|max:100',
            'portfolio_title' => 'required|max:100',
            'owner_name' => 'required|max:100',
            'short_description_title' => 'required|max:300',
            'more_description_title' => 'required',
            'short_description' => 'required|max:300',
            'more_description' => 'required',
            'service_id' => 'required',
            'portfolio_image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'portfolio_cover' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        if(preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->portfolio_name[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->portfolio_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->owner_name[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->short_description_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->more_description_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->short_description[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->more_description[2])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->portfolio_name[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->portfolio_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->owner_name[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->short_description_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->more_description_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->short_description[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->more_description[1])) 
        {

            if ($request->hasFile('portfolio_image')) {
            $portfolio_image = Storage::disk('edit_path')->putFile('images/portfolio', $request->file('portfolio_image'));
            } else {
                $portfolio_image = 'images/portfolio/avatar_portfolio.png';
            }

            if ($request->hasFile('portfolio_cover')) {
                $portfolio_cover = Storage::disk('edit_path')->putFile('images/portfolio/cover', $request->file('portfolio_cover'));
            } else {
                $portfolio_cover = null;
            }

            $portfolio = DB::table('portfolio')
                ->insertGetId([
                    'service_id' => $request->service_id,
                    'portfolio_image' => $portfolio_image,
                    'portfolio_link' => $request->portfolio_link,
                    'ios_link' => $request->ios_link,
                    'android_link' => $request->android_link,
                    'date' => $request->date,
                    'portfolio_cover' => $portfolio_cover
                ]);

            for ($i = 1; $i <= 2; $i++){
                $portfolio_description = DB::table('portfolio_descriptions')
                    ->insert([
                        'portfolio_name' => $request->portfolio_name[$i],
                        'portfolio_title' => $request->portfolio_title[$i],
                        'owner_name'=> $request->owner_name[$i],
                        'short_description_title'=> $request->short_description_title[$i],
                        'short_description'=> $request->short_description[$i],
                        'more_description_title'=> $request->more_description_title[$i],
                        'more_description'=> $request->more_description[$i],
                        'language_id' => $i,
                        'portfolio_id' => $portfolio
                    ]);
            }

        } else {

            if(!preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->portfolio_name[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->portfolio_title[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->owner_name[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->short_description_title[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->more_description_title[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->short_description[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->more_description[2])) {
                $error = trans('admin.name or title or description must be contain only english characters');
            } else {
                $error = trans('admin.name or title or description must be contain only arabic characters');
            }
            return Redirect::back()->withInput($request->all())->with('error', $error);

        }

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminEdit($id){
    	$portfolios = DB::table('portfolio')
            ->join('portfolio_descriptions', 'portfolio_descriptions.portfolio_id', '=', 'portfolio.portfolio_id')
            ->select('portfolio.portfolio_id as id', 'portfolio_image', 'portfolio_name', 'portfolio_title',
	        'portfolio_link', 'ios_link', 'android_link', 'date', 'portfolio_cover', 'owner_name', 'short_description_title',
	        'short_description', 'more_description_title', 'more_description', 'service_id')
            ->where('portfolio.portfolio_id', '=', $id)
            ->orderBy('portfolio.portfolio_id', 'desc')
            ->get();

        $services = DB::table('services')
        	->join('service_descriptions', 'service_descriptions.service_id', '=', 'services.service_id')
        	->select('services.service_id as id', 'service_name as name')
        	->where('language_id', '=', language())
        	->get();

        return view('admin_panel.portfolio.edit', compact('portfolios', 'services'));
    }

    public function adminUpdate(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'portfolio_name' => 'required|max:100',
            'portfolio_title' => 'required|max:100',
            'owner_name' => 'required|max:100',
            'short_description_title' => 'required|max:300',
            'more_description_title' => 'required',
            'short_description' => 'required|max:300',
            'more_description' => 'required',
            'service_id' => 'required',
            'portfolio_image' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'portfolio_cover' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        if(preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->portfolio_name[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->portfolio_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->owner_name[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->short_description_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->more_description_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->short_description[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->more_description[2])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->portfolio_name[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->portfolio_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->owner_name[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->short_description_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->more_description_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->short_description[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->more_description[1])) 
        {
            if ($request->hasFile('portfolio_image')) {
                $getImage = DB::table('portfolio')->where('portfolio_id', '=', $id)->select('portfolio_image')->first();
                if($getImage->portfolio_image != 'images/portfolio/avatar_portfolio.png'){
                    $myFile = base_path($getImage->portfolio_image);
                    File::delete($myFile);
                }
                $portfolio_image = Storage::disk('edit_path')->putFile('images/portfolio', $request->file('portfolio_image'));
            } else {
                $portfolio_image = $request->old_portfolio_image;
            }

            if ($request->hasFile('portfolio_cover')) {
                $getImage = DB::table('portfolio')->where('portfolio_id', '=', $id)->select('portfolio_cover')->first();
                if($getImage->portfolio_cover != 'images/portfolio/cover/avatar_portfolio.png'){
                    $myFile = base_path($getImage->portfolio_cover);
                    File::delete($myFile);
                }
                $portfolio_cover = Storage::disk('edit_path')->putFile('images/portfolio/cover', $request->file('portfolio_cover'));
            } else {
                $portfolio_cover = $request->old_portfolio_cover;
            }

            $items = DB::table('portfolio')
                ->where('portfolio_id', '=', $id)
                ->update([
                    'service_id' => $request->service_id,
                    'portfolio_image' => $portfolio_image,
                    'portfolio_link' => $request->portfolio_link,
                    'ios_link' => $request->ios_link,
                    'android_link' => $request->android_link,
                    'date' => $request->date,
                    'portfolio_cover' => $portfolio_cover
                ]);

            for ($i = 1; $i <= 2; $i++){
                $description = DB::table('portfolio_descriptions')
                    ->where('portfolio_id', '=', $id)
                    ->where('language_id', '=', $i)
                    ->update([
                        'portfolio_name' => $request->portfolio_name[$i],
                        'portfolio_title' => $request->portfolio_title[$i],
                        'owner_name'=> $request->owner_name[$i],
                        'short_description_title'=> $request->short_description_title[$i],
                        'short_description'=> $request->short_description[$i],
                        'more_description_title'=> $request->more_description_title[$i],
                        'more_description'=> $request->more_description[$i],
                    ]);
            }

        } else {

            if(!preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->portfolio_name[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->portfolio_title[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->owner_name[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->short_description_title[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->more_description_title[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->short_description[2])
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->more_description[2])) {
                $error = trans('admin.name or title or description must be contain only english characters');
            } else {
                $error = trans('admin.name or title or description must be contain only arabic characters');
            }
            return Redirect::back()->withInput($request->all())->with('error', $error);

        }

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminDestroy($id){
    	$getImage = DB::table('portfolio')->where('portfolio_id', '=', $id)->select('portfolio_image')->first();
        if($getImage->portfolio_image != 'images/portfolio/avatar_portfolio.png'){
            $myFile = base_path($getImage->portfolio_image);
            File::delete($myFile);
        }
        $portfolio = DB::table('portfolio')
            ->where('portfolio_id', '=', $id)
            ->delete();
    }

}
