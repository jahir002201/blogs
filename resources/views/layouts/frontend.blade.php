<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>My Personal Blog</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

     .searching{
        position: relative;
     }

     #blogList {
        position: absolute;
        opacity: 0.9;
        top: 50px;
        z-index: 2;
     }

    @media (max-width: 990px) {
       #blogList{
        top: 90px;
        right:20px;
         }

       }


        main {
          flex:1;  
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <a class="navbar-brand" href="{{route('index')}}">My Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  searchig" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" id="searchInput"  placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-dark" type="submit" id="searchBtn" >Search</button>
                </form>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('about_me')}}">About Me</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact_us')}}">Contact Us</a>
                </li>
                <div class="d-flex flex-row-reverse mt-2" id="blogList"></div>
            </ul>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="bg-light text-dark text-center p-3 mt-4">
        <p>Copyright &copy; 2023 Design and Developed by Jahir</p>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
 
</script>
<script>
    $(document).ready(function() {
        $("#searchBtn").click(function(event) {
            event.preventDefault();
            var query = $("#searchInput").val();
    
            // Check if the query is not empty
            if (query.trim() !== '') {
                $.ajax({
                    method: "POST",
                    url: '{{route("search")}}',
                    data: { query: query },
                    success: function(blogs) {
                       
                        $("#blogList").html(blogs);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
    </script>
    
</body>
</html>
