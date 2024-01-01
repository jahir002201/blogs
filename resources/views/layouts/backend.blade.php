<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Include Summernote CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
</head>
<body class="d-flex flex-column min-vh-100">


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Admin Dashboard</a>

    <!-- Profile Section -->
    <div class="ml-auto">
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
            <!-- Display the generated avatar image -->
            @if(Auth::user()->profile_image)
            {{-- If the user has a profile image, display it --}}
           <img src="{{ asset('backend/photos/' . Auth::user()->profile_image) }}" alt="Profile Photo" class="rounded-circle" width="50" height="50" style="border: 1px solid #ddd;">
            @else
                <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="Profile Photo" class="rounded-circle" width="50" height="50" style="border: 1px solid #ddd;">
                @endif    
                {{Auth::user()->name}}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('profile')}}">Profile</a>
                <ul class="dropdown-divider"></ul>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </ul>            
        </div>
    </div>
</nav>
<!-- Sidebar and Content -->
<div class="container-fluid flex-grow-1">
    <div class="row">
        
<!-- Sidebar -->
<nav class="col-md-2 bg-light sidebar">
    
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users') }}">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
            
            <li class="nav-item">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="fas fa-blog"></i> Blogs
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item text-primary" href="{{route('category')}}">Category</a>
                    <ul class="dropdown-divider"></ul>
                    <a class="dropdown-item text-primary" href="{{route('sub_category')}}">Sub Category</a>
                    <ul class="dropdown-divider"></ul>
                    <a class="dropdown-item text-primary" href="{{route('blog_post')}}">Blog post</a>
                </div>
            </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-users"></i> Others
                </a>
            </li>
            <!-- Add more menu items as needed -->
        </ul>
    </div>
    
</nav>

        <!-- Content -->
        <main role="main" class="col-md-9 ml-md-auto col-lg-10 px-md-4 d-flex">
            @yield('content')
        </main>
    </div>
</div>



<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light text-center">
    <div class="container">
        <span class="text-muted">Copyright &copy; 2023 Design and Developed by Jahir</span>
    </div>
</footer>
<!-- Bootstrap JS and dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
@yield('ajax_script')
</body>
</html>
