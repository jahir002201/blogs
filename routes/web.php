<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\SearchController;


//Frontend show
Route::get('/',[FrontendController::class,'index'])->name('index');

//Single blog page
Route::get('/single_page/{blog_id}',[FrontendController::class,'single_page'])->name('single_page');



//Contact Us
Route::get('/contact_us',[FrontendController::class,'contact_us'])->name('contact_us');

//About Me
Route::get('/about_me',[FrontendController::class,'about_me'])->name('about_me');



Auth::routes();


//Deshboard 
Route::get('/home', [HomeController::class, 'home'])->name('home');
//profile 
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
//profile update
Route::post('/profile_update', [HomeController::class, 'profile_update'])->name('profile.update');
//users List
Route::get('/users', [HomeController::class, 'users'])->name('users');

//user edit
Route::get('/edit_user/{user_id}', [HomeController::class,'editUser'])->name('edit_user');
//user update
Route::post('/user_update', [HomeController::class,'user_update'])->name('user_update');
// Add the delete route
Route::get('/delete_user/{id}', [HomeController::class, 'deleteUser'])->name('delete_user');

//CategoryController routes go here
Route::get('/category',[CategoryController::class, 'category'])->name('category'); 
Route::post('/post_category',[CategoryController::class,'post_category'])->name('post_category');
Route::get('/edit_category/{category_id}',[CategoryController::class,'edit_category'])->name('edit_category');
Route::post('/update_category',[CategoryController::class,'update_category'])->name('update_category');
Route::get('/delete_category/{category_id}',[CategoryController::class,'delete_category'])->name('delete_category');


//SubCategoryController routes go here
Route::get('/sub_category',[SubCategoryController::class,'sub_category'])->name('sub_category');
Route::get('/options_category',[SubCategoryController::class,'options_category'])->name('options_category');
Route::post('/post_sub_category',[SubCategoryController::class,'post_sub_category'])->name('post_sub_category');
//sub category edit view
Route::get('/edit_sub_category/{sub_category_id}',[SubCategoryController::class,'edit_sub_category'])->name('edit_sub_category');
//sub category update 
Route::post('/update_sub_category',[SubCategoryController::class,'update_sub_category'])->name('update_sub_category');
//sub category delete
Route::get('/delete_sub_category/{sub_category_id}',[SubCategoryController::class,'delete_sub_category'])->name('delete_sub_category');



//Blog post
Route::get('/blog_post', [BlogsController::class, 'blogPost'])->name('blog_post');
//Blog post inserted
Route::post('/blog_insert', [BlogsController::class,'blogInsert'])->name('blog_insert');
//sub category options
Route::post('/sub_options', [BlogsController::class,'sub_options'])->name('sub_options');
//Edit blog
Route::get('/edit_blog/{blog_id}', [BlogsController::class,'edit_blog'])->name('edit_blog');
//Update blog
Route::post('/update_blog', [BlogsController::class,'update_blog'])->name('update_blog');
//delete_blog
Route::get('/delete_blog/{blog_id}', [BlogsController::class,'delete_blog'])->name('delete_blog');


//Searching blog
Route::post('/search', [SearchController::class, 'search'])->name('search');






