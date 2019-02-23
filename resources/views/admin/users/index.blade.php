@extends('layouts.admin')

@section('content')

    @if (Session::has('user_deleted'))
        <p>{{ session('user_deleted') }}</p>
    @endif

    <h1>Users</h1>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        @if($users)
            <tbody>
            @foreach ($users as $user)
                
                <tr>
                <td>{{ $user->id }}</td>
                <td><img height="50" src="{{ $user->photo ? $user->photo->path : 'http://placehold.it/400x400' }}" alt=""></td>
                <td><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
                <td>{{ $user->role ? $user->role->name : 'User has no role' }}</td>
                <td>{{ $user->is_active == 1 ? 'Active' : 'Pending' }}</td>
                </tr>
            
            @endforeach
            </tbody>
        @endif
        </table>
    
@endsection