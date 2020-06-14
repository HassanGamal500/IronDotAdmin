<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function language(){
    if (session()->get('locale') == 'ar') {
        return 1;
    } else {
        return 2;
    }
}

function getLanguage(){
    if (session()->get('locale') == 'ar') {
        return 1;
    } else {
        return 2;
    }
}

// function languageApi($lang){
//     if($lang == 2){
//         App::setLocale('ar');
//     } else {
//         App::setLocale('en');
//     }
// }

function messageContact(){
    $contacts = DB::table('contact_us')->latest()->take(5)->get();
    return $contacts;
}

// function messageCount(){
//     $count = DB::table('contacts')->where('contact_read', '=', 0)->count();
//     return $count;
// }

function getImage(){
    $user = DB::table('administration')
        ->where('id', '=', Auth::guard('admin')->user()->id)
        ->select('name', 'image')
        ->first();
    return $user;
}

// /*
// function setting(){
//     $currency = DB::table('setting_description')->where('language_id', '=', language())->first();
//     return $currency;
// }*/

// function convert($string) {
//     $arabic = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩',','];
//     $num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.'];
//     $englishNumbersOnly = str_replace($arabic, $num, $string);

//     return $englishNumbersOnly;
// }

// function get_local_time($ip){

// //   $ip = $request->getClientIp();

//    $url = 'http://ip-api.com/json/'.$ip;

//    $tz = file_get_contents($url);

//    $tz = json_decode($tz,true)['timezone'];

//    date_default_timezone_set($tz);
   
//    return date('Y/m/d H:i:s');

// }

?>
