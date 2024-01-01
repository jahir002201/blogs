<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
 
 }

    //Blog post show
    public function blogPost(){
        $categories = Category::all();
        $blogs = Blog::latest()->get();
        return view('backend.blog.blog_post',['categories'=> $categories,'blogs'=> $blogs]);
    }


    //sub category options

    public function sub_options(Request $request){
        $sub_categories = SubCategory::where('category_id', $request->category_id)->get();
        $options='';
        foreach ($sub_categories as $sub_category){
            $options .= '<option value="'.$sub_category->id.'">'.$sub_category->name.'</option>';
        }

        return $options;
    }


    //Blog post Insert
    public function blogInsert(Request $request){
       // Validate the request data
       $request->validate([
        'sub_category_id'=> 'required',
        'title' => 'required|string',
        'author' => 'required|string',
        'description'=> 'required|string',
        'blog_content' => 'required|string',
        ]);
       // Handle the image upload if it exists
    if ($request->image ) {
     // Validate the request data
  
      $request->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      ]);
    $image = $request->file('image');
    $imageName = Str::random(10).'_image'.'.'. $image->getClientOriginalExtension();
    $image->move(public_path('backend/blogs'),$imageName);
    } else {
             
       $imageName = null;
    
      }

    // Insert data into the blogs table
    Blog::create([
      'image' => $imageName,
    'category_id'=> $request->category_id,
    'sub_category_id'=> $request->sub_category_id,
    'author' => $request->author,
    'title' => $request->title,
    'description'=> $request->description,
    'content' => $request->blog_content,
    ]);

    return back()->with('success', 'Blog post created successfully.');

    }

//Edit blog
 public function edit_blog($blog_id){
    $blog = Blog::find($blog_id);

     return view('backend.blog.edit_blog', compact('blog'));
 }

//update blog
  public function update_blog(Request $request){

    $blogs = Blog::find($request->blog_id);

    if($request->image == ""){
    
    // Validate the request data
    $request->validate([
        'sub_category_id'=> 'required',
        'title' => 'required|string',
        'author' => 'required|string',
        'description' => 'required|string',
        'blog_content' => 'required|string',
        ]);
  
  // update blog
  
    Blog::find($request->blog_id)->update([
    'category_id'=> $request->category_id,
    'sub_category_id'=> $request->sub_category_id,
    'title' => $request->title,
    'author' => $request->author,
    'description'=> $request->description,
    'content' => $request->blog_content,
    ]);

    return back()->with('success', 'Blog update successfully.');

  }else if(!$request->image == ""){
     
       // Validate the request data
       $request->validate([
        'sub_category_id'=> 'required',
        'title' => 'required|string',
        'author' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'blog_content' => 'required|string',
        ]);
 
    if(!$blogs->image == null){
        unlink(public_path('backend/blogs/'.$blogs->image));
      }
    $image = $request->image;
    $imageName = Str::random(10).'_image'.'.'. $image->getClientOriginalExtension();
    $image->move(public_path('backend/blogs'),$imageName);
    // update blog
  
    Blog::find($request->blog_id)->update([
    'category_id'=> $request->category_id,
    'sub_category_id'=> $request->sub_category_id,
    'title' => $request->title,
    'author' => $request->author,
    'image' => $imageName,
    'description' => $request->description,
    'content' => $request->blog_content,
    ]);

    return back()->with('success', 'Blog update successfully.');
  }else{
    return back()->with('error', 'Blog not update successfully.');
  }

 }

//delete_blog
public function delete_blog($blog_id){
  $blog = Blog::find($blog_id);
  $blog->delete();

  return back()->with('success','Delete successfully.');
}



}
