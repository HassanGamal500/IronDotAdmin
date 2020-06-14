<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminJobController extends Controller
{
    public function index(){
        $jobs = DB::table('jobs')
            ->join('job_description', 'job_description.job_id', '=', 'jobs.job_id')
            ->select('jobs.job_id as id', 'job_image as image', 'job_image as name', 'active')
            ->where('job_description.language_id', '=', language())
            ->orderBy('jobs.job_id', 'desc')
            ->get();
        return view('admin_panel.job.index', compact('jobs'));
    }

    public function adminCreate(){
        return view('admin_panel.job.create');
    }

    public function adminStore(Request $request){
        $validator = validator()->make($request->all(), [
            'job_title' => 'required|max:100',
            'job_description' => 'required',
            'job_image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'job_start' => 'required',
            'job_end' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        if ($request->hasFile('job_image')) {
            $job_image = Storage::disk('edit_path')->putFile('images/job', $request->file('job_image'));
        } else {
            $job_image = 'images/job/avatar_job.png';
        }

        $job = DB::table('jobs')
            ->insertGetId([
                'job_image' => $job_image,
                'start_job' => $request->job_start,
                'end_job' => $request->job_end
            ]);

        for ($i = 1; $i <= 2; $i++){
            $job_description = DB::table('job_description')
                ->insert([
                    'job_title' => $request->job_title[$i],
                    'job_description'=> $request->job_description[$i],
                    'language_id' => $i,
                    'job_id' => $job
                ]);
        }

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminEdit($id){
    	$jobs = DB::table('jobs')
            ->join('job_description', 'job_description.job_id', '=', 'jobs.job_id')
            ->select('jobs.job_id as id', 'job_image', 'job_title', 'job_description', 'start_job', 'end_job')
            ->where('jobs.job_id', '=', $id)
            ->get();

        return view('admin_panel.job.edit', compact('jobs'));
    }

    public function adminUpdate(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'job_title' => 'required|max:100',
            'job_description' => 'required',
            'job_image' => 'nullable|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'job_start' => 'required',
            'job_end' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        if ($request->hasFile('job_image')) {
            $getImage = DB::table('services')->where('service_id', '=', $id)->select('job_image')->first();
            if($getImage->job_image != 'images/job/avatar_job.png'){
                $myFile = base_path($getImage->job_image);
                File::delete($myFile);
            }
            $job_image = Storage::disk('edit_path')->putFile('images/service', $request->file('job_image'));
        } else {
            $job_image = $request->old_job_image;
        }

        $job = DB::table('jobs')
            ->where('job_id', '=', $id)
            ->update([
                'job_image' => $job_image,
                'start_job' => $request->job_start,
                'end_job' => $request->job_end
            ]);

        for ($i = 1; $i <= 2; $i++){
            $description = DB::table('job_description')
                ->where('job_id', '=', $id)
                ->where('language_id', '=', $i)
                ->update([
                    'job_title' => $request->job_title[$i],
                    'job_description'=> $request->job_description[$i]
                ]);
        }   

        $message = App::isLocale('ar') ? 'تم التسجيل بنجاح' : 'Inserted Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function adminDestroy($id){
    	$getImage = DB::table('jobs')->where('job_id', '=', $id)->select('job_image')->first();
        if($getImage->job_image != 'images/job/avatar_job.png'){
            $myFile = base_path($getImage->job_image);
            File::delete($myFile);
        }
        $product = DB::table('jobs')
            ->where('job_id', '=', $id)
            ->delete();
    }
}
