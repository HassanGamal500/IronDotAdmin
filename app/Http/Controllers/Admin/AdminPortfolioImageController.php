<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminPortfolioImageController extends Controller
{
    public function index($id){
        $images = DB::table('portfolio_images')
            ->select('portfolio_images_id as id', 'image')
            ->where('portfolio_id', '=', $id)
            ->orderBy('portfolio_images_id', 'desc')
            ->get();

        return view('admin_panel.portfolio_image.index', compact('images', 'id'));
    }

    public function adminStore(Request $request){
        $validator = validator()->make($request->all(), [
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        if ($request->hasFile('image')) {
            foreach($request->image as $image) {
                $imageName = Storage::disk('edit_path')->putFile('images/portfolio_image', $image);
                $img = DB::table('portfolio_images')->insert(['image' => $imageName, 'portfolio_id' => $request->portfolio_id]);
            }
        } else {
            $error = trans('admin.something wrong');
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }


        $message = session()->get('locale') == 'ar' ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    // public function adminEdit($id){
    //     $image = DB::table('images')
    //         ->select('image_id as id', 'image')
    //         ->orderBy('image_id', 'desc')
    //         ->first();

    //     return view('admin_panel.portfolio_images.edit', compact('image'));
    // }

    // public function adminUpdate(Request $request, $id){
    //     $validator = validator()->make($request->all(), [
    //         'image' => 'nullable',
    //     ]);

    //     if ($validator->fails()) {
    //         $error = $validator->errors()->first();
    //         return Redirect::back()->with('error', $error);
    //     }

    //     $getImage = DB::table('images')->where('image_id', '=', $id)->select('image')->first();
    //     $image = $request->image;

    //     if ($request->hasFile('image')) {
    //         if($getImage->image != 'images/restaurant/avatar_restaurant.png'){
    //             $myFile = base_path($getImage->image);
    //             File::delete($myFile);
    //         }
    //         $imageName = Storage::disk('edit_path')->putFile('images/restaurant', $image);
    //         $img = DB::table('images')->where('image_id', '=', $id)->update(['image' => $imageName]);
    //     } else {
    //         $imageName = $request->old_image;
    //         $img = DB::table('images')->where('image_id', '=', $id)->update(['image' => $imageName]);
    //     }

    //     $message = session()->get('locale') == 'ar' ? 'تم التعديل بنجاح' : 'Updated Successfully';

    //     return Redirect::back()->with('message', $message);
    // }

    public function adminDestroy($id){
        $getImage = DB::table('portfolio_images')->where('portfolio_images_id', '=', $id)->select('image')->first();
        $myFile = base_path($getImage->image);
        File::delete($myFile);
        $image = DB::table('portfolio_images')
            ->where('portfolio_images_id', '=', $id)
            ->delete();
    }
}
