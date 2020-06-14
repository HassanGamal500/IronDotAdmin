<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminFeedbackController extends Controller
{
    public function index(){
        $feedbacks = DB::table('feedback')
            ->select('id', 'name', 'position', 'text')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin_panel.feedback.index', compact('feedbacks'));
    }

    public function adminDestroy($id){
        $product = DB::table('feedback')
            ->where('id', '=', $id)
            ->delete();
    }
}
