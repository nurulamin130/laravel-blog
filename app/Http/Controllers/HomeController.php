<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private static $blog;

    public function index(){
        return view('front-end.home.home',[
          'blogs' =>  Blog::where('status',1)
              ->orderBy('id', 'desc')
              ->skip(1)
              ->take(5)
              ->get(),
        ]);
    }

    public function about(){
        return view('front-end.about.about');
    }

    public function blogDetails($slug){
       self::$blog = Blog::where('slug',$slug)->first();
       return view('front-end.blog.details',['details'=>self::$blog]);
    }
}
