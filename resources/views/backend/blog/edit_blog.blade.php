@extends('layouts.backend')
@section('content')
<div class="container mt-3">
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
 <div class="card">
   <div class="card-header">
    <h2 class="text-center">Blog Edit</h2>
   </div>
   <div class="card-header">
    <form method="POST" action="{{route('update_blog')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Blog Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @error('image')
            <strong class="text text-danger">{{$message}}</strong>
            @enderror
            <input type="hidden" name="blog_id" value="{{$blog->id}}" >
            <!-- Image preview container -->
            <div id="imagePreviewContainer">
                @if($blog->image)
                    <img src="{{ asset('backend/blogs/' .$blog->image) }}" alt="Default Profile Image" class="img-thumbnail" id="previewImage" style="max-width: 150px; max-height: 150px;">
                @endif
            </div> 
        </div>

        <div class="form-group">
            <label for="category">Category Name</label>
            <select class="form-control category" id="category" name="category_id">
            </select>
        </div>
        <div class="form-group">
            <label for="sub_category">Sub Category Name</label>
            <select class="form-control category" id="sub_category" name="sub_category_id" required>

            </select>
        </div>
        <div class="form-group">
            <label for="author">Author Name</label>
            <input type="text" class="form-control" id="author" value="{{$blog->author}}" name="author" required>
            @error('author')
            <strong class="text text-danger">{{$message}}</strong>   
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Blog Title</label>
            <input type="text" class="form-control" id="title" value="{{$blog->title}}" name="title" required>
            @error('title')
            <strong class="text text-danger">{{$message}}</strong>   
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Blog Description</label>
            <textarea class="form-control" id="description"  name="description" rows="3" required>{{$blog->description}}</textarea>
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
@endsection
@section('ajax_script')
<script>
    $("#category").ready(function() {
        var category_id = @json($blog->category_id);
        $.ajax({
            method: "GET",
            url:'{{ url("options_category")}}',
            data:this.data,
            success:function(data){
                $("#category").html(data);
                $("#category").val(category_id);

                
                $("#category").click(function(){
                var category_id = $(this).val();
                $.ajax({
                method:"POST",
                url:"{{route('sub_options')}}",
                data:{category_id:category_id},
                success: function(data){
                $("#sub_category").html(data);
                }
              });
            });          
       }
    
    });
 // Assuming you have the content stored in a variable like $blog->content
 var blogContent = {!! json_encode($blog->content) !!};
    $('#summernote').summernote({
               
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
 

        // Set the initial content of Summernote
        $('#summernote').summernote('code', blogContent);
 });
</script>
@endsection