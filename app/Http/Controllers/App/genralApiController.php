<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Storage;
//use Session;
//use Auth;
class genralApiController extends Controller
{
    public function home(){
        $lang=1;
        $data['title'] = trans('website.home');
        $data['about'] = DB::table('about_us')
            ->leftJoin('about_us_descriptions', 'about_us_descriptions.about_us_id', 'about_us.about_us_id')
            ->where('about_us_descriptions.language_id', $lang)
            ->get();
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions', 'services.service_id', 'service_descriptions.service_id')
            ->where('service_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->limit(4)->get();
        $data['portfolio'] = DB::table('portfolio')
            ->leftJoin('portfolio_descriptions', 'portfolio.portfolio_id', 'portfolio_descriptions.portfolio_id')
            ->where('portfolio_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->get();
        $data['partners'] = DB::table('partners')->orderBy('partner_id', 'desc')->where('active', '=', 1)->get();
        
        for ($i=0; $i < 4; $i++) { 
            $data['teams'][$i] = DB::table('teams')->where('active', '=', 1)->first();
        }
        $data['feedback'] = DB::table('feedback')->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function aboutUs(){
        $lang=1;
        $data['title']=trans('website.aboutUs');
        $data['about'] = DB::table('about_us')
            ->leftJoin('about_us_descriptions','about_us_descriptions.about_us_id','about_us.about_us_id')
            ->where('about_us_descriptions.language_id',$lang)
            ->get();
        $data['feedback'] = DB::table('feedback')->get();
        $data['$teams'] = DB::table('teams')->where('active', '=', 1)->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions', 'services.service_id', 'service_descriptions.service_id')
            ->where('service_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->limit(4)->get();
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function blog(){
        $lang=1;
        $data['title']=trans('website.blog');
        $data['blogs'] = DB::table('blog')
            ->leftJoin('blog_descriptions', 'blog_descriptions.blog_id', '=', 'blog.blog_id')
            ->orderBy('blog.blog_id', 'desc')
            ->where('blog_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions', 'services.service_id', 'service_descriptions.service_id')
            ->where('service_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->limit(4)->get();
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function singleBlog(Request $request){
        $id=$request->id;
        $lang=1;
        $data['blogs'] = DB::table('blog')
            ->leftJoin('blog_descriptions', 'blog_descriptions.blog_id', "=", 'blog.blog_id')
            ->where('blog_descriptions.blog_id', $id)
            ->where('blog_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->get();
        $data['allBlogs'] = DB::table('blog')
            ->leftJoin('blog_descriptions', 'blog_descriptions.blog_id', '=', 'blog.blog_id')
            ->orderBy('blog.blog_id', 'desc')
            ->where('blog_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->limit(3)
            ->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions', 'services.service_id', 'service_descriptions.service_id')
            ->where('service_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->limit(4)->get();
        $data['title']=$data['blogs'][0]->blog_title;
        $data['image']=$data['blogs'][0]->blog_image_small;
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function contactUs(){
        $lang=1;
        $data['$title']=trans('website.contactUs');
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions','services.service_id','service_descriptions.service_id')
            ->where('service_descriptions.language_id',$lang)
            ->where('active', '=', 1)
            ->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function services(){
        $lang=1;
        $data['title']=trans('website.ourServices');
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions','services.service_id','service_descriptions.service_id')
            ->where('service_descriptions.language_id',$lang)
            ->where('active', '=', 1)
            ->get();
        $data['feedback'] = DB::table('feedback')->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function portfolio(){
        $lang=1;
        $data['title']=trans('website.portfolio');
        $data['portfolio'] = DB::table('portfolio')
            ->leftJoin('portfolio_descriptions','portfolio.portfolio_id','portfolio_descriptions.portfolio_id')
            ->where('portfolio_descriptions.language_id',$lang)
            ->where('active', '=', 1)
            ->get();
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions','services.service_id','service_descriptions.service_id')
            ->where('service_descriptions.language_id',$lang)
            ->where('active', '=', 1)
            ->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function projectDetail(Request $request){
        $id=$request->id;
        $lang=1;
        $data['portfolio'] = DB::table('portfolio')
            ->leftJoin('portfolio_descriptions','portfolio.portfolio_id','portfolio_descriptions.portfolio_id')
            ->where('portfolio_descriptions.language_id',$lang)
            ->where('portfolio.portfolio_id', $id)
            ->where('active', '=', 1)
            ->get();
        $data['portfolio_images'] = DB::table('portfolio_images')
            ->where('portfolio_id', $id)
            ->get();
        $data['allPortfolios'] = DB::table('portfolio')
            ->leftJoin('portfolio_descriptions','portfolio.portfolio_id','portfolio_descriptions.portfolio_id')
            ->where('portfolio_descriptions.language_id',$lang)
            ->where('active', '=', 1)
            ->limit(10)
            ->orderBy('portfolio.portfolio_id','DESC')
            ->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions', 'services.service_id', 'service_descriptions.service_id')
            ->where('service_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->limit(4)->get();
        $data['title']=$data['portfolio'][0]->portfolio_name;
        $data['image']=$data['portfolio'][0]->portfolio_image;
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function product(){
        $lang=1;
        $data['title']=trans('website.product');
        $data['product'] = DB::table('product')
            ->leftJoin('product_descriptions','product.product_id','product_descriptions.product_id')
            ->where('product_descriptions.language_id',$lang)
            ->where('active', '=', 1)
            ->get();
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions','services.service_id','service_descriptions.service_id')
            ->where('service_descriptions.language_id',$lang)
            ->where('active', '=', 1)
            ->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function productDetail(Request $request){
        $id=$request->id;
        $lang=1;
        $data['product'] = DB::table('product')
            ->leftJoin('product_descriptions','product.product_id','product_descriptions.product_id')
            ->where('product_descriptions.language_id',$lang)
            ->where('product.product_id', $id)
            ->where('active', '=', 1)
            ->get();
        $data['product_images'] = DB::table('product_images')
            ->where('product_id', $id)
            ->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions', 'services.service_id', 'service_descriptions.service_id')
            ->where('service_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->limit(4)->get();
        $data['title']=$data['product'][0]->product_name;
        $data['image']=$data['product'][0]->product_image;
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function addSubscriber(Request $request){
        $mail = $request->mail;
        $rules = [
            'mail' => 'required|email',
        ];
        $niceNames = [
            'mail' => trans('website.mail')
        ];
        $messages = [];
        $validator = \Validator::make(request()->all(), $rules, $messages, $niceNames);
        $getCount = DB::table('subscribers')
            ->where('subscribers_mail', $mail)
            ->count();
        if ($validator->passes()) {
            if ($getCount == 0) {
                DB::table('subscribers')->insert([
                    'subscribers_mail' => $mail
                ]);
                /*$gmail = DB::table('settings')
                    ->leftJoin('settings_descriptions','settings_descriptions.settings_description_id','settings.settings_id')
                    ->get()[0]->contact_email;
                \Mail::send('webSite.mails.contactMail', $data, function($message) use ($data,$gmail) {
                    $message->from($data['contact_us_email'],$data['contact_us_name']);
                    $message->to($gmail, trans('labels.appName'))
                        ->replyTo($data['contact_us_email'])
                        ->subject
                        ('United Arab Group');
                });*/
                return 1;
            } else {
                return 2;
            }
        } else {
            $error = implode("\n", $validator->errors()->all());
            return $error;
        }
    }

    public function sendContact(Request $request){
        $name           =   $request->name;
        $phone          =   $request->phone;
        $email          =   $request->email;
        $message        =   $request->message;
        $subject        =   $request->subject;
        $website_url    =   $request->website_url;
        $services_id    =   $request->value;

        //inser into DB
        $id = DB::table('contact_us')->insertGetId([
            'contact_us_name' => $name,
            'contact_us_email' => $email,
            'contact_us_phone' => $phone,
            'contact_us_message' => $message,
            'contact_us_subject'=>$subject,
            'website_url'=>$website_url,
            'services_id'=>$services_id,
        ]);

        if($services_id){
            $services_name = DB::table('services')
            ->leftJoin('service_descriptions','service_descriptions.service_id','services.service_id')
            ->where('language_id','2')
            ->where('services.service_id',$services_id)
            ->where('active', '=', 1)
            ->get()[0]->service_name;
        }else{
            $services_name='';
        }
        //collect data for me 
        $data = array(
            'contact_us_name'=>$name,
            'contact_us_email'=>$email,
            'contact_us_phone'=>$phone,
            'contact_us_message'=>$message,
            'contact_us_subject'=>$subject,
            'website_url'=>$website_url,
            'services_name'=>$services_name,
        );
        if (!isset($request->name)) {
            $name='Client';
        }
        //get contact mail
        $gmail = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_description_id','settings.settings_id')
            ->get()[0]->contact_email;

        //sending mail to us
        \Mail::send('website.mails.contactMail', $data, function($message) use ($data,$gmail,$name) {
            $message->from($data['contact_us_email'],$name);
            $message->to($gmail, 'IRONDOT')
                ->replyTo($data['contact_us_email'],$name)
                ->subject($data['contact_us_subject']);
        });
        
        $responseData = array('success'=>'1', 'data'=>'',  'message'=>"successful");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function terms (){
        $title=trans('website.terms');
        $pages = DB::table('pages')
            ->leftJoin('pages_description','pages_description.page_id','pages.page_id')
            ->where('pages_description.language_id',getLanguage())
            ->where('pages.page_id','1')
            ->get();
        return view('website.terms')->with('pages',$pages)->with('title',$title);
    }

    public function privacy (){
        $title=trans('website.privacy');
        $pages = DB::table('pages')
            ->leftJoin('pages_description','pages_description.page_id','pages.page_id')
            ->where('pages_description.language_id',getLanguage())
            ->where('pages.page_id','2')
            ->get();
        return view('website.terms')->with('pages',$pages)->with('title',$title);
    }


    // feedback

    public function feedback()
    {
        $feedback = DB::table('feedback')->get();
        $responseData = array('success'=>'1', 'data'=>$feedback,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function team(){
        $lang=1;
        $data['title'] = trans('website.team member');
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions', 'services.service_id', 'service_descriptions.service_id')
            ->where('service_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->limit(4)->get();        
        for ($i=0; $i < 4; $i++) { 
            $data['teams'][$i] = DB::table('teams')->first();
        }
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function job(){
        $lang=1;
        $data['title'] = trans('website.career');
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions', 'services.service_id', 'service_descriptions.service_id')
            ->where('service_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->limit(4)->get();        
        $data['jobs'] = DB::table('jobs')
            ->join('job_description', 'job_description.job_id', '=', 'jobs.job_id')
            ->where('language_id', '=', $lang)
            ->where('end_job', '>=', date('Y-m-d'))
            ->where('active', '=', 1)
            ->get();
        // $data['jobs'] = DB::table('jobs')
        //                     ->join('job_description', 'job_description.job_id', '=', 'jobs.job_id')
        //                     ->where('language_id', '=', $lang)
        //                     ->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function jobDetail($id){
        $lang=1;
        $data['title'] = trans('website.career');
        $data['services'] = DB::table('services')
            ->leftJoin('service_descriptions', 'services.service_id', 'service_descriptions.service_id')
            ->where('service_descriptions.language_id', $lang)
            ->where('active', '=', 1)
            ->limit(4)->get();        
        $data['jobs'] = DB::table('jobs')
            ->join('job_description', 'job_description.job_id', '=', 'jobs.job_id')
            ->where('language_id', '=', $lang)
            ->where('jobs.job_id', '=', $id)
            ->where('active', '=', 1)
            ->first();
        // $data['jobs'] = DB::table('jobs')
        //                     ->join('job_description', 'job_description.job_id', '=', 'jobs.job_id')
        //                     ->where('language_id', '=', $lang)
        //                     ->get();
        $data['footer'] = DB::table('settings')
            ->leftJoin('settings_descriptions','settings_descriptions.settings_id','=','settings.settings_id')
            ->orderBy('settings.settings_id','desc')
            ->where('settings_descriptions.language_id',$lang)
            ->get();
        $responseData = array('success'=>'1', 'data'=>$data,  'message'=>"Returned all data");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function applyJob(Request $request){
        $validator = validator()->make($request->all(), [
            'name' => 'required|max:80',
            'email' => 'required|max:255',
            'phone' => 'required|max:11',
            'title' => 'required|max:80',
            'description' => 'nullable',
            'cv' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $responseData = array('success'=>'0', 'data'=>'',  'message'=>$error);
            $categoryResponse = json_encode($responseData);
            return $categoryResponse;
        }

        if ($request->hasFile('cv')) {
            $apply_cv = Storage::disk('edit_path')->putFile('images/apply', $request->file('cv'));
        }
        $apply = DB::table('apply_job')->insert([
            'apply_name' => $request->name,
            'apply_email' => $request->email,
            'apply_phone' => $request->phone,
            'apply_title' => $request->title,
            'apply_description' => $request->description,
            'apply_cv' => $apply_cv
        ]);
        $responseData = array('success'=>'1', 'data'=>'',  'message'=>"successful");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }
}