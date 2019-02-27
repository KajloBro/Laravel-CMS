@extends('layouts.admin')

@section('content')

    @include('includes.tinymce')

    <h1>Create Post</h1>
    
    {!! Form::open(['method' => 'POST', 'action' => 'AdminPostsController@store', 'files' => true]) !!}

    {{-- Title --}}
    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {{-- Category --}}
    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', array('' => 'Select category') + $categories, null, ['class' => 'form-control']) !!}
    </div>

    {{-- Body --}}
    <div class="form-group">
        {!! Form::label('body', 'Content:') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '5']) !!}
    </div>

    {{-- Photo --}}
    <div class="form-group">
        {!! Form::label('photo_id', 'Photo:') !!}
        {!! Form::file('photo_id', ['class' => 'form-control']) !!}
    </div>

    {{-- Submit --}}
    <div class="form-group">
        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
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