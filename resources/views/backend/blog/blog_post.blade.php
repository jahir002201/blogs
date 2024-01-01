@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
   <div class="row mt-5">
        <div class="col-lg-8">
        <div class="card">
        <div class="card-header">
            <h2 class="text-center">Blog Post Form</h2>
        </div>
        <div class="card-body">
    
            <form method="POST" action="{{route('blog_insert')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Blog Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @error('image')
                    <strong class="text text-danger">{{$message}}</strong>   
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Category Name</label>
                    <select class="form-control category" id="category" name="category_id">
                    @foreach ($categories as $category)
                    <option  value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sub_category">Sub Category Name</label>
                    <select class="form-control category" id="sub_category" name="sub_category_id" required></select>
                    @error('sub_category')
                    <strong class="text text-danger">{{$message}}</strong>   
                    @enderror
                </div>
                <div class="form-group">
                    <label for="author">Author Name</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                    @error('author')
                    <strong class="text text-danger">{{$message}}</strong>   
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="title">Blog Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                    @error('title')
                    <strong class="text text-danger">{{$message}}</strong>   
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="description">Blog Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    @error('description')
                    <strong class="text text-danger">{{$message}}</strong>   
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summernote">Blog Content</label>
                    <textarea class="form-control" id="summernote" name="blog_content" required></textarea>
                    @error('blog_content')
                    <strong class="text text-danger">{{$message}}</strong>   
                    @enderror
                </div> 
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Blog List</h2>
                </div>
                  <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Image</th>
                                <th scope="col">Author Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Sub category</th>

                                <th scope="col">Blog Title</th>
                                <th scope="col">Blog Content</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($blogs as $blog)   
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                            @if($blog->image)
                                <img src="{{ asset('backend/blogs/' . $blog->image) }}" alt="Profile Photo" class="rounded-circle" width="50" height="50" style="border: 1px solid #ddd;">
                            @endif
                            </td>
                            <td>{{$blog->author}}</td>
                            <td>{{$blog->category->name}}</td>
                            <td>{{$blog->sub_category->name}}</td>
                            
                            <td>{{$blog->title}}</td>
                            <td>{{ Illuminate\Support\Str::limit(strip_tags($blog->description), 30) }}</td>
                            <td>{{$blog->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('edit_blog', $blog->id)}}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{route('delete_blog',$blog->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        
                        @endforeach
                        </tbody>
                    </table>
                </div>   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('ajax_script')

<script>

    $("#category").click(function(){
        var category_id = $(this).val();
        $.ajax({
            method: "POST",
            url :'{{route("sub_options")}}',
            data:{'category_id': category_id},
            success: function(data) {
            $("#sub_category").html(data);
            }
    
        });
    });

    $('#summernote').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
      });
 </script>
@endsection
