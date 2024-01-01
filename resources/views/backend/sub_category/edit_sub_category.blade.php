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
            <h2>SubCategory Edit</h2>
        </div>
        <div class="card-body">
            <form action="{{route('update_sub_category')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="category">Category Name</label>
                    <select class="form-control category" id="category" name="category_id">

                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Sub Category Name</label>
                    <input type="text" name="sub_category" value="{{$sub_category->name}}" class="form-control" required id="name">
                    <input type="hidden" name="sub_category_id" value="{{$sub_category->id}}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
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
                $("#category").val(category_id);
            }
    
        });
     });
</script>
@endsection