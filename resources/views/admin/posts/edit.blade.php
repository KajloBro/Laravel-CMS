@extends('layouts.admin')

@section('content')

    <h1>Edit Post</h1>
    
    <img height="80" src="{{ $post->photo->path }}" alt="">

    {!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}

    {{-- Title --}}
    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {{-- Category --}}
    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
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
    <div class="form-group col-sm-6">
        {!! Form::submit('Update Post', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}



    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id], 'files' => true]) !!}

        {{-- Submit --}}
        <div class="form-group pull-right">
            {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
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