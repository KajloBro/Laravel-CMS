@extends('layouts.admin')

@section('content')

    <h1>Edit User</h1>

    <div class="col-sm-12">
        <div class="col-sm-3">
            <img height="300" src="{{ $user->photo ? $user->photo->path : 'http://placehold.it/400x400' }}" alt="">    
        </div>
    </div>

    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files' => true]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('title', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not active'), null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', array('' => 'Choose option') + $roles, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-3">
            {!! Form::submit('Update User', ['class' => 'btn btn-primary btn-block']) !!}
        </div>

    {!! Form::close() !!}




    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!}

        <div class="form-group col-sm-3">
            {!! Form::submit('Delete User', ['class' => 'btn btn-danger btn-block pull-right']) !!}
        </div>

    {!! Form::close() !!}



    @if (count($errors) > 0)

        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        
    @endif
    
@endsection