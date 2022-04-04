<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class handleDynamicRoute extends Controller
{
    public function DynamicRoute(Request $request, $route){

        $page = Pages::where('slug',$route)->first();
        if(is_null($page)){
            App::abort(404);
        }
       return view('front_page', ['page'=>$page]);
   
    }
}
