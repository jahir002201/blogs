@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h2>User List</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Profile Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop through your users here --}}
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        @if($user->profile_image)
                        <img src="{{ asset('backend/photos/' . $user->profile_image) }}" alt="Profile Photo" class="rounded-circle" width="50" height="50" style="border: 1px solid #ddd;">
                        @else
                        <img src="{{ Avatar::create($user->name)->toBase64() }}" alt="Profile Photo" class="rounded-circle" width="50" height="50" style="border: 1px solid #ddd;">
                        @endif
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    <td>
                        <!-- Add your actions here, e.g., edit, delete, etc. -->
                        <a href="{{route('edit_user',$user->id)}}" class="btn btn-info btn-sm">Edit</a>
                        <a href="{{route('delete_user',$user->id)}}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
                {{-- End loop --}}
            </tbody>
        </table>
    </div>
</div>
@endsection