<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class SearchController extends Controller
{
 
    public function search(Request $request){
        $query = $request->input("query");

        $blogs = Blog::where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")->latest()->get();

         return view("backend.blog.search.blog_list",compact("blogs"))->render();
        
    }



}

