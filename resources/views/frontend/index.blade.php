@extends('layouts.frontend')
@section('content')
 <!-- Blog Content -->
 <div class="container-expand">
    <div class="row">
        <div class="col-md-8">
            <!-- Blog posts go here -->
            <!-- Loop through each blog post -->
            @foreach ($blogs as $blog)
            <div class="col-md-12 bg-light shadow-lg mt-4 p-2">
                <h2>{{ $blog->title }}</h2>
                <p>Published on: {{ $blog->created_at->format('F j, Y') }}</p>
                <p>Author: {{ $blog->author }}</p>
                @if($blog->image)
                <img src="{{ asset('backend/blogs/'.$blog->image) }}" alt="Blog Post Image" class="img-fluid">
                @endif
                <p>{{ Illuminate\Support\Str::limit(strip_tags($blog->description), 150) }} <a href="{{route('single_page',$blog->id)}}">Read more</a></p>
                <i class="fas fa-folder"></i> <a href="">{{$blog->category->name}} </a>
            </div>
            @endforeach

           <!-- Repeat for other blog posts -->


          <!-- Pagination Links -->
          <nav aria-label="Page navigation">
            <ul class="pagination mt-2 justify-content-center">
        
                <!-- Previous Page Link -->
                @if($blogs->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true">&laquo; Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $blogs->previousPageUrl() }}" rel="prev" aria-label="Previous">&laquo; Previous</a>
                    </li>
                @endif
        
                <!-- Pagination Elements -->
            
            @php
            $startPage = max($blogs->currentPage() - 1, 1);
            $endPage = min($blogs->currentPage() + 1, $blogs->lastPage());                    
            @endphp

            @for ($page = $startPage; $page <= $endPage; $page++)
            @if ($page == $blogs->currentPage())

                  <li class="page-item active" aria-current="page">
                  <span class="page-link">{{ $page }}</span>
                 </li>

            @else

                <li class="page-item">
                <a class="page-link" href="{{ $blogs->url($page) }}">{{ $page }}</a>
                </li>

            @endif
            @endfor
                <!-- Next Page Link -->
                @if ($blogs->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $blogs->nextPageUrl() }}" rel="next" aria-label="Next">Next &raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true">Next &raquo;</span>
                    </li>
                @endif
        
            </ul>
        </nav>
        </div>

        <!-- Sidebar (Others) -->
        <div class="col-md-4">
        <div class="col-md-10 bg-light shadow-lg mt-4 p-2">
            <h4>Other Content</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt fugit cum rerum iste voluptatem saepe ex! Soluta cumque, nisi quasi vel eveniet id. Assumenda quos veritatis laudantium aliquid at excepturi?</p>
        </div>
        <!-- Add other content here -->
        </div>
    </div>
</div>

@endsection
