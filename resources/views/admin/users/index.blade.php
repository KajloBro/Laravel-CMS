@extends('layouts.admin')

@section('content')

    <h1>Users</h1>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
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
                <td>{{ $user->name }}</td>
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