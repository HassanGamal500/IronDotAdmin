<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
    	$portfolios = DB::table('portfolio')->count();
    	$products = DB::table('product')->count();
    	$services = DB::table('services')->count();
     	$blogs = DB::table('blog')->count();
    	$partners = DB::table('partners')->count();
    	$teams = DB::table('teams')->count();
    	$contacts = DB::table('contact_us')->count();
    	$feedbacks = DB::table('feedback')->count();

        return view('admin_panel.dashboard',compact('portfolios', 'products', 'services', 'blogs', 'partners', 'teams', 'contacts', 'feedbacks'));
    }
}
