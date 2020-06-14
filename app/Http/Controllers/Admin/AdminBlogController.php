<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
     public function index(){
        $blogs = DB::table('blog')
            ->join('blog_descriptions', 'blog_descriptions.blog_id', '=', 'blog.blog_id')
            ->select('blog.blog_id as id', 'blog_image_small as image', 'blog_title as title', 'active')
            ->where('blog_descriptions.language_id', '=', language())
            ->orderBy('blog.blog_id', 'desc')
            ->get();
        return view('admin_panel.blog.index', compact('blogs'));
    }

    public function adminCreate(){
        return view('admin_panel.blog.create');
    }

    public function adminStore(Request $request){
        $validator = validator()->make($request->all(), [
            'blog_title' => 'required|max:100',
            'blog_sub_content' => 'required|max:300',
            'blog_content' => 'required',
            'date' => 'required',
            'blog_image_small' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'blog_image_large' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        if(preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->blog_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->blog_sub_content[2])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->blog_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->blog_sub_content[1])) 
        {
            if ($request->hasFile('blog_image_small')) {
                $blog_image_small = Storage::disk('edit_path')->putFile('images/blog', $request->file('blog_image_small'));
            } else {
                $blog_image_small = 'images/blog/avatar_blog.png';
            }

            if ($request->hasFile('blog_image_large')) {
                $blog_image_large = Storage::disk('edit_path')->putFile('images/blog', $request->file('blog_image_large'));
            } else {
                $blog_image_large = 'images/blog/avatar_blog.png';
            }

            $blog = DB::table('blog')
                ->insertGetId([
                    'blog_date' => $request->date,
                    'blog_image_small' => $blog_image_small,
                    'blog_image_large' => $blog_image_large
                ]);

            for ($i = 1; $i <= 2; $i++){
                $portfolio_description = DB::table('blog_descriptions')
                    ->insert([
                        'blog_title' => $request->blog_title[$i],
                        'blog_sub_content'=> $request->blog_sub_content[$i],
                        'blog_content'=> $request->blog_content[$i],
                        'language_id' => $i,
                        'blog_id' => $blog
                    ]);
            }
        } else {
            if(!preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->blog_title[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->blog_sub_content[2])) {
                $error = trans('admin.name or title or content must be contain only english characters');
            } else {
                $error = trans('admin.name or title or content must be contain only arabic characters');
            }
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminEdit($id){
    	$blogs = DB::table('blog')
            ->join('blog_descriptions', 'blog_descriptions.blog_id', '=', 'blog.blog_id')
            ->select('blog.blog_id as id', 'blog_image_small', 'blog_image_large', 'blog_title',
	        'blog_date', 'blog_image_large', 'blog_sub_content', 'blog_content')
            ->where('blog.blog_id', '=', $id)
            ->orderBy('blog.blog_id', 'desc')
            ->get();

        return view('admin_panel.blog.edit', compact('blogs'));
    }

    public function adminUpdate(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'blog_title' => 'required|max:100',
            'blog_sub_content' => 'required|max:300',
            'blog_content' => 'required',
            'date' => 'required',
            'blog_image_small' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'blog_image_large' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        if(preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->blog_title[2])
        && preg_match("/^[A-Za-z0-9_.,{}@#!~%()-<>\s].*[A-Za-z0-9_.,{}@#!~%()-<>\s]+$/", $request->blog_sub_content[2])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->blog_title[1])
        && !preg_match("/^[A-Za-z].*[A-Za-z]+$/", $request->blog_sub_content[1])) 
        {
            if ($request->hasFile('blog_image_small')) {
                $getImage = DB::table('blog')->where('blog_id', '=', $id)->select('blog_image_small')->first();
                if($getImage->blog_image_small != 'images/blog/avatar_blog.png'){
                    $myFile = base_path($getImage->blog_image_small);
                    File::delete($myFile);
                }
                $blog_image_small = Storage::disk('edit_path')->putFile('images/blog', $request->file('blog_image_small'));
            } else {
                $blog_image_small = $request->old_blog_image_small;
            }

            if ($request->hasFile('blog_image_large')) {
                $getImage = DB::table('blog')->where('blog_id', '=', $id)->select('blog_image_large')->first();
                if($getImage->blog_image_large != 'images/blog/avatar_blog.png'){
                    $myFile = base_path($getImage->blog_image_large);
                    File::delete($myFile);
                }
                $blog_image_large = Storage::disk('edit_path')->putFile('images/blog', $request->file('blog_image_large'));
            } else {
                $blog_image_large = $request->old_blog_image_large;
            }

            $blog = DB::table('blog')
                ->where('blog_id', '=', $id)
                ->update([
                    'blog_date' => $request->date,
                    'blog_image_small' => $blog_image_small,
                    'blog_image_large' => $blog_image_large
                ]);

            for ($i = 1; $i <= 2; $i++){
                $description = DB::table('blog_descriptions')
                    ->where('blog_id', '=', $id)
                    ->where('language_id', '=', $i)
                    ->update([
                        'blog_title' => $request->blog_title[$i],
                        'blog_sub_content'=> $request->blog_sub_content[$i],
                        'blog_content'=> $request->blog_content[$i]
                    ]);
            }
        } else {
            if(!preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->blog_title[2]) 
                && !preg_match("/^[A-Za-z0-9].*[A-Za-z0-9]+$/", $request->blog_sub_content[2])) {
                $error = trans('admin.name or title or content must be contain only english characters');
            } else {
                $error = trans('admin.name or title or content must be contain only arabic characters');
            }
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminDestroy($id){
    	$getImageFirst = DB::table('blog')->where('blog_id', '=', $id)->select('blog_image_small')->first();
        if($getImageFirst->blog_image_small != 'images/blog/avatar_blog.png'){
            $myFile = base_path($getImageFirst->blog_image_small);
            File::delete($myFile);
        }
        $getImageSecond = DB::table('blog')->where('blog_id', '=', $id)->select('blog_image_large')->first();
        if($getImageSecond->blog_image_large != 'images/blog/avatar_blog.png'){
            $myFile = base_path($getImageSecond->blog_image_large);
            File::delete($myFile);
        }
        $portfolio = DB::table('blog')
            ->where('blog_id', '=', $id)
            ->delete();
    }

    public function uploadImage(Request $request) {
        $CKEditor = $request->input('CKEditor');
        $funcNum  = $request->input('CKEditorFuncNum');
        $message  = $url = '';
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            if ($file->isValid()) {
                // $filename =rand(1000,9999).$file->getClientOriginalName();
                // $file->move(public_path().'/wysiwyg/', $filename);
                // $url = url('wysiwyg/' . $filename);
                $blog_image = Storage::disk('edit_path')->putFile('images/blog/description', $file);
                $url = url($blog_image);
            } else {
                $message = 'An error occurred while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }
}
