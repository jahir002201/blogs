@extends('layouts.backend')
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
<div class="row justify-content-center mt-2">
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h2>SubCategory Add</h2>
        </div>
        <div class="card-body">
                    <form action="{{route('post_sub_category')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category">Category Name</label>
                            <select class="form-control category" id="category" name="category_id">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Sub Category Name</label>
                            <input type="text" name="sub_category" class="form-control" required id="name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
        </div>
    </div>
</div>
</div>
<div class="row justify-content-center mt-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>SubCategory List</h2>
            </div>
            <div class="card-body">
            <table class="table">
             <tr>
                <th>SL</th>
                <th>Category</th>
                <th>Sub Category </th>
                <th>Date</th>
                <th>Action</th>
             </tr>
             @foreach ($sub_categories as $sub_category)
             <tr>
                 <td>{{$loop->iteration}}</td>
                 <td>{{$sub_category->category->name}}</td>
                 <td>{{$sub_category->name}}</td>
                 <td>{{$sub_category->created_at->format('d-m-Y')}}</td>
                 <td>
                    <a href="{{route('edit_sub_category',$sub_category->id)}}" class="btn btn-info btn-sm">Edit</a>
                    <a href="{{route('delete_sub_category',$sub_category->id)}}" class="btn btn-danger btn-sm" id="delet">Delete</a>
                    </td>
                @endforeach
              </tr>
            </table>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('ajax_script')
<script>
    $("#category").ready(function() {
        var category_id = @json($sub_category->category_id);
        $.ajax({
            method: "GET",
            url:'{{ url("options_category")}}',
            data:this.data,
            success:function(data){
                $("#category").html(data);
            }
    
        });
     });
</script>
@endsection