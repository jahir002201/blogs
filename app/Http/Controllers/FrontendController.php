<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class FrontendController extends Controller
{
 //index show
     public function index(){
        $blogs= Blog::latest()->paginate(3);
        return view('frontend.index',compact('blogs'));
    }


//single blog page show
    public function single_page($blog_id){
    $blog= Blog::find($blog_id);

     return view('frontend.single_blog_page',compact('blog'));
    }

 //contract us show
    public function contact_us(){
        return view('frontend.contact_us');
    }
 //About Me show
    public function about_me(){
        return view('frontend.about_me');
    }

}
