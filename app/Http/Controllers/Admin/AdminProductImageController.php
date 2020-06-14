<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminProductImageController extends Controller
{
    public function index($id){
        $images = DB::table('product_images')
            ->select('product_images_id as id', 'image')
            ->where('product_id', '=', $id)
            ->orderBy('product_images_id', 'desc')
            ->get();

        return view('admin_panel.product_image.index', compact('images', 'id'));
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
                $imageName = Storage::disk('edit_path')->putFile('images/product_image', $image);
                $img = DB::table('product_images')->insert(['image' => $imageName, 'product_id' => $request->product_id]);
            }
        } else {
            $error = trans('admin.something wrong');
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }


        $message = session()->get('locale') == 'ar' ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminDestroy($id){
        $getImage = DB::table('product_images')->where('product_images_id', '=', $id)->select('image')->first();
        $myFile = base_path($getImage->image);
        File::delete($myFile);
        $image = DB::table('product_images')
            ->where('product_images_id', '=', $id)
            ->delete();
    }
}
