@extends('layouts.frontend')
 @section('content')
 <!-- Blog Content -->
 <div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Blog posts go here -->
            <div class="col-md-12 bg-light shadow-lg p-2">

                @if($blog->image)
                <img src="{{ asset('backend/blogs/'.$blog->image) }}" alt="Blog Post Image" class="img-fluid">
                @endif
                <h2>{{ $blog->title }}</h2>
                <p>Published on: {{ $blog->created_at->format('F j, Y') }}</p>
                <p>Author: {{ $blog->author }}</p>
                <p> {!!$blog->content!!}</p>
                <i class="fas fa-folder"></i> <a href="#">{{$blog->category->name}} </a>
            </div>
        </div>
    </div>
</div>
@endsection