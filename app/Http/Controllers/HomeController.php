<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   

     //Home page show
     public function home(){
        return view('backend.admin.home');
    }

    //profile page show
    public function profile(){
           return view('backend.admin.profile');
    }

  // profile update
  public function profile_update(Request $request){

    $user = Auth::user();
    $hashPass=(Hash::check($request->current_password, Auth::user()->password));
    $conPass=$request->new_password==$request->new_password_confirmation;
    if(($request->profile_image=="" && $request->new_password=="") && (!$request->name=="" && !$request->email=="")){
       
      // user name email validation
      $request->validate([
        'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255',
      ]);
      //user name email update
      $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return back()->with('success', 'Profile updated successfully');

    }else if($hashPass && ($request->profile_image=="" && !$request->new_password=="") && (!$request->name=="" && !$request->email=="")){
  
      // user name email password validation
      $request->validate([
        'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255',
        'current_password' => 'required|password',
        'new_password' => 'required|string|min:8|confirmed',
      ]);
      // user name email password update
      $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->new_password,
    ]);

    return back()->with('success', 'Profile updated successfully');

    }else if((!$request->profile_image=="" && $request->new_password=="") && (!$request->name=="" && !$request->email=="")){
     //profile_image user name email validation
     $request->validate([
      'profile_image' => 'required|max:2048|image|mimes:png,jpg,gif',
      'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
      'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255',
      ]);
    //user name email update
      $image = $request->file('profile_image');
      $imageName ='profile_image'.Auth::user()->id.'.'.$image->getClientOriginalExtension();
      $image->move(public_path('backend/photos'),$imageName);
    $user->update([
      'profile_image' => $imageName, 
      'name' => $request->name,
      'email' => $request->email,
      ]);
      
      return back()->with('success', 'Profile updated successfully');

    }else if($conPass && $hashPass && (!$request->profile_image=="" && !$request->new_password=="") && (!$request->name=="" && !$request->email=="")){

    //profile_image user name email validation
    $request->validate([
      'profile_image' => 'required|max:2048|image|mimes:png,jpg,gif',
      'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
      'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255',
      'current_password' => 'required|password',
      'new_password' => 'required|string|min:8|confirmed',
      ]);
    //user name email update
      $image = $request->file('profile_image');
      $imageName ='profile_image'.Auth::user()->id.'.'.$image->getClientOriginalExtension();
      $image->move(public_path('backend/photos'),$imageName);

    $user->update([
      'profile_image' => $imageName, 
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->new_password, 
      ]);
      
      return back()->with('success', 'Profile updated successfully');


    }else{
      return back()->with('error','Profile not updated successfully');
    }

  }

//users list

public function users(){
  $users = User::all();
  return view('backend.admin.users', compact('users'));
}

// Edit users
public function editUser($user_id){
  $user = User::where ('id', $user_id)->first();
  return view('backend.admin.edit_user', compact('user'));
}

// users update
public function user_update(Request $request){
  $user = User::where ('id', $request->user_id)->first();
   $hashPass=(Hash::check($request->current_password, $user->password));
   $conPass=$request->new_password==$request->new_password_confirmation;
   $authImg=$user->profile_image;

   if(($request->profile_image=="" && $request->new_password=="") && (!$request->name=="" && !$request->email=="")){
       
    // user name email validation
    $request->validate([
      'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
      'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255',
    ]);
    //user name email update
    $user->update([
      'name' => $request->name,
      'email' => $request->email,
  ]);

  return back()->with('success', 'User Profile updated successfully');

  }else if($hashPass && ($request->profile_image=="" && !$request->new_password=="") && (!$request->name=="" && !$request->email=="")){

    // user name email validation
    $request->validate([
      'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
      'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255',
      'current_password' => 'required|password',
      'new_password' => 'required|string|min:8|confirmed',
    ]);
    // user name email password update
    $user->update([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->new_password,
  ]);

  return back()->with('success', 'User Profile updated successfully');

  }else if((!$request->profile_image=="" && $request->new_password=="") && (!$request->name=="" && !$request->email=="")){
   //profile_image user name email validation
   $request->validate([
    'profile_image' => 'required|max:2048|image|mimes:png,jpg,gif',
    'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
    'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255',
    ]);
  //user name email update
  $photo = $user->profile_image;
  if(!$authImg == null){
    unlink(public_path('backend/photos/'.$photo));
   }
    $image = $request->file('profile_image');
    $imageName ='profile_image'.$user->id.'.'.$image->getClientOriginalExtension();
    $image->move(public_path('backend/photos'),$imageName);
  $user->update([
    'profile_image' => $imageName, 
    'name' => $request->name,
    'email' => $request->email,
    ]);
    
    return back()->with('success', 'User Profile updated successfully');

  }else if($conPass && $hashPass && (!$request->profile_image=="" && !$request->new_password=="") && (!$request->name=="" && !$request->email=="")){

  //profile_image user name email validation
  $request->validate([
    'profile_image' => 'required|max:2048|image|mimes:png,jpg,gif',
    'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
    'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255',
    'current_password' => 'required|password',
    'new_password' => 'required|string|min:8|confirmed',
    ]);
  //user name email profile_image update
  $photo = $user->profile_image;
   if(!$authImg == null){
    unlink(public_path('backend/photos/'.$photo));
    }
    $image = $request->file('profile_image');
    $imageName ='profile_image'.$user->id.'.'.$image->getClientOriginalExtension();
    $image->move(public_path('backend/photos'),$imageName);

    $user->update([
    'profile_image' => $imageName, 
    'name' => $request->name,
    'email' => $request->email,
    'password' => $request->new_password, 
    ]);
    
     return back()->with('success', 'User Profile updated successfully');


  }else{
    return back()->with('error','User Profile not updated successfully');
  }

}


  //deleteUser
  public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }






}
