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
            <form action="{{route('update_category')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" value="{{$category->name}}" class="form-control">
                    <input type="hidden" name="id" value="{{$category->id}}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection