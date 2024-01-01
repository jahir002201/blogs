<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function __construct(){
      
        $this->middleware('auth');
    }


// subCategory data show
public function sub_category(){
    $sub_categories = SubCategory::all();
    return view('backend.sub_category.sub_category', compact('sub_categories'));
}

//options_category
public function options_category(){
    $categories = category::all();
    $options='';
    foreach($categories as $category){
    $options .= '<option name="category_id" value="'.$category->id.'">'.$category->name.'</option>';
    }
    return $options;
}

//post_sub_category
public function post_sub_category(Request $request){
 
    $request->validate([
     'sub_category' => 'required|string|max:255',
    ]);
//sub_category insert
SubCategory::create([
'name' => $request->sub_category,
'category_id' => $request->category_id,
]);

  return back()->with('success','Insert category successfully');
}

//edit sub category view
public function edit_sub_category($sub_category_id){
    $sub_category = SubCategory::find($sub_category_id);
    return view('backend.sub_category.edit_sub_category', compact('sub_category'));
}

//update_sub_category

public function update_sub_category(Request $request){
$request->validate([
    'name' => $request->sub_category,
]);

SubCategory::find($request->sub_category_id)->update([
    'name'=> $request->sub_category,
    'category_id'=> $request->category_id,
]);

  return back()->with('success','Update Sub Category Successfully');
}


//delete_sub_category

public function delete_sub_category($sub_category_id){
SubCategory::find($sub_category_id)->delete();

return back()->with('success','Delete Sub Category Successfully');
}



}
