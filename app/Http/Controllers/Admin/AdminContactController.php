<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminContactController extends Controller
{
    public function index(){
        $contacts = DB::table('contact_us')
        	->join('service_descriptions', 'service_descriptions.service_id', '=', 'contact_us.services_id')
            ->select('contact_us_id as id', 'contact_us_email', 'contact_us_subject', 'contact_us_name', 'contact_us_message', 'contact_us_phone', 'contact_us_country', 'website_url', 'service_name')
            ->where('service_descriptions.language_id', '=', language())
            ->orderBy('contact_us_id', 'desc')
            ->get();
        return view('admin_panel.contact.index', compact('contacts'));
    }

    public function adminDestroy($id){
        $product = DB::table('contact_us')
            ->where('contact_us_id', '=', $id)
            ->delete();
    }
}
