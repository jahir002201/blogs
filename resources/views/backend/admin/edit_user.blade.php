@extends('layouts.backend')
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('user_update')}}" enctype="multipart/form-data">
                        @csrf
                       

                        <!-- Add your form fields here -->
                          <!-- image field -->
                          <div class="form-group">
                            <label for="profile_image">{{ __('Profile Image') }}</label>
                            <input id="profile_image" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image"  accept="image/*" >
                            @error('profile_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror                           
                            <!-- Image preview container -->
                            <div id="imagePreviewContainer">
                                @if($user->profile_image)
                                    <img src="{{ asset('backend/photos/' . $user->profile_image) }}" alt="Default Profile Image" class="img-thumbnail" id="previewImage" style="max-width: 150px; max-height: 150px;">
                                @endif
                            </div> 
                        </div>
                        

                       <!-- name field  -->
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                         <!-- email field -->
                        <div class="form-group">
                            <label for="email">{{ __('email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <!-- Current Password field -->
                        <div class="form-group">
                            <label for="current_password">{{ __('Current Password') }}</label>
                            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password"  autocomplete="current-password">

                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <!-- New Password field -->
                        <div class="form-group">
                            <label for="new_password">{{ __('New Password') }}</label>
                            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password"  autocomplete="new-password">
                            
                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <!-- Confirm Password field -->
                        <div class="form-group">
                            <label for="new_password_confirmation">{{ __('Confirm Password') }}</label>
                            <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation"  autocomplete="new-password">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                        </div>
                        
                        <!-- Add more form fields as needed -->
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection