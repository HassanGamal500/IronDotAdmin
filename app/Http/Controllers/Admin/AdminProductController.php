<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index(){
        $products = DB::table('product')
            ->join('product_descriptions', 'product_descriptions.product_id', '=', 'product.product_id')
            ->select('product.product_id as id', 'product_image as image', 'product_name as name', 'product_title as title', 'active')
            ->where('product_descriptions.language_id', '=', language())
            ->orderBy('product.product_id', 'desc')
            ->get();
        return view('admin_panel.product.index', compact('products'));
    }

    public function adminCreate(){
        return view('admin_panel.product.create');
    }

    public function adminStore(Request $request){
        $validator = validator()->make($request->all(), [
            'product_name' => 'required|max:100',
            'product_title' => 'required|max:100',
            'more_description_title' => 'required',
            'more_description' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        if(preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->product_name[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->product_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->more_description_title[2])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->product_name[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->product_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->more_description_title[1])) 
        {
            if ($request->hasFile('product_image')) {
                $product_image = Storage::disk('edit_path')->putFile('images/product', $request->file('product_image'));
            } else {
                $product_image = 'images/product/avatar_product.png';
            }

            $product = DB::table('product')
                ->insertGetId([
                    'product_image' => $product_image,
                    'product_link' => $request->product_link,
                    'date' => $request->date,
                ]);

            for ($i = 1; $i <= 2; $i++){
                $portfolio_description = DB::table('product_descriptions')
                    ->insert([
                        'product_name' => $request->product_name[$i],
                        'product_title' => $request->product_title[$i],
                        'more_description_title'=> $request->more_description_title[$i],
                        'more_description'=> $request->more_description[$i],
                        'language_id' => $i,
                        'product_id' => $product
                    ]);
            }
        } else {
            if(!preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->product_name[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->product_title[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->more_description_title[2])) {
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
    	$products = DB::table('product')
            ->join('product_descriptions', 'product_descriptions.product_id', '=', 'product.product_id')
            ->select('product.product_id as id', 'product_image', 'product_name', 'product_title',
	        'product_link', 'date', 'more_description_title', 'more_description')
            ->where('product.product_id', '=', $id)
            ->orderBy('product.product_id', 'desc')
            ->get();

        return view('admin_panel.product.edit', compact('products'));
    }

    public function adminUpdate(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'product_name' => 'required|max:100',
            'product_title' => 'required|max:100',
            'more_description_title' => 'required',
            'more_description' => 'required',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        if(preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->product_name[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->product_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->more_description_title[2])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->product_name[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->product_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->more_description_title[1])) 
        {
            if ($request->hasFile('product_image')) {
                $getImage = DB::table('product')->where('product_id', '=', $id)->select('product_image')->first();
                if($getImage->product_image != 'images/product/avatar_product.png'){
                    $myFile = base_path($getImage->product_image);
                    File::delete($myFile);
                }
                $product_image = Storage::disk('edit_path')->putFile('images/product', $request->file('product_image'));
            } else {
                $product_image = $request->old_product_image;
            }

            $items = DB::table('product')
                ->where('product_id', '=', $id)
                ->update([
                    'product_image' => $product_image,
                    'product_link' => $request->product_link,
                    'date' => $request->date,
                ]);

            for ($i = 1; $i <= 2; $i++){
                $description = DB::table('product_descriptions')
                    ->where('product_id', '=', $id)
                    ->where('language_id', '=', $i)
                    ->update([
                        'product_name' => $request->product_name[$i],
                        'product_title' => $request->product_title[$i],
                        'more_description_title'=> $request->more_description_title[$i],
                        'more_description'=> $request->more_description[$i],
                    ]);
            }
        } else {
            if(!preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->product_name[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->product_title[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->more_description_title[2])) {
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
    	$getImage = DB::table('product')->where('product_id', '=', $id)->select('product_image')->first();
        if($getImage->product_image != 'images/product/avatar_product.png'){
            $myFile = base_path($getImage->product_image);
            File::delete($myFile);
        }
        $product = DB::table('product')
            ->where('product_id', '=', $id)
            ->delete();
    }
}
