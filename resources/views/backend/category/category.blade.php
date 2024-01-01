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
            <h2>Category Add</h2>
        </div>
        <div class="card-body">
                    <form action="{{route('post_category')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" required>
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
    <h2>Category list:</h2>
    </div>
    <div class="card-body">
    <table class="table">
     <tr>
        <th>SL</th>
        <th>Category</th>
        <th>Date</th>
        <th>Actinon</th>
     </tr> 
        {{-- Loop through your category here --}}
        @foreach($categories as $category) 
     <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->created_at->format('d-m-Y')}}</td>
        <td>
            <a href="{{route('edit_category',$category->id)}}" class="btn btn-info btn-sm">Edit</a>
            <a href="{{route('delete_category',$category->id)}}" class="btn btn-danger btn-sm">Delete</a>
        </td>
     </tr>
     @endforeach
    </table>
    </div>
   </div>
  </div>
 </div>
 </div>
@endsection
