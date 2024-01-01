<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // category page show

    public function category(){
        $categories = Category::all();
      return view('backend.category.category', compact('categories'));
    }
// category post
public function post_category(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
    ]);
 // category insert

  Category::create([
    'name'=> $request->name,
 ]);


  return back()->with('success','Insert category successfully');
}

// Edite category
public function edit_category($category_id){
$category = Category::find($category_id);
return view('backend.category.edit_category', compact('category'));

}
//update_category
public function update_category(Request $request){

    $request->validate([
        'name'=> 'required|string|max:255',
    ]);
    $category = Category::find($request->id);
    $category->update([
        'name'=> $request->name,
    ]);

    return back()->with('success','Updated category successfully');
}
//delete_category
public function delete_category($category_id){
    $category = Category::find($category_id);
    $category->delete();
    return back()->with('success','deleted category successfully');
}





}
