@extends('layouts.admin')

@section('content')

    <h1>Comments</h1>

    @if (count($comments)) 

        <table class="table text-center">
            <thead>
                <tr class="text-center">
                    <th class="text-center">ID</th>
                    <th class="text-center">Post</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Body</th>
                    <th class="text-center">Replies</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)

                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td><a href="{{ route('post', $comment->post_id) }}">{{ $comment->post->title }}</a></td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ str_limit($comment->body, 17) }}</td>
                        <td><a href="{{ route('admin.comments.replies.show', $comment->id)}}">View replies</a></td>

                        @if ($comment->is_active == 0) 
                            
                            <td>    
                                {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                                    {!! Form::hidden('is_active', '1') !!}
                                    {!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                            </td>
                        @else
                            <td> 
                                {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                                    {!! Form::hidden('is_active', '0') !!}
                                    {!! Form::submit('Inappropriate', ['class' => 'btn btn-warning']) !!}
                                {!! Form::close() !!}
                            </td>
                        @endif
                        <td> 
                            {!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                            {!! Form::close() !!}
                        </td>

                    </tr>
                    
                @endforeach
            </tbody>
        </table>
        
    @else

        <p>No comments</p>
    
    @endif

@endsection