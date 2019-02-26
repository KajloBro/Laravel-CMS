@extends('layouts.admin')

@section('content')

    <h1>Replies</h1>

    @if (count($replies)) 

        <table class="table text-center">
            <thead>
                <tr class="text-center">
                    <th class="text-center">ID</th>
                    <th class="text-center">Post</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Body</th>
                    <th class="text-center">Comment</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($replies as $reply)

                    <tr>
                        <td>{{ $reply->id }}</td>
                        <td><a href="{{ route('post', $reply->comment->post->id) }}">{{ $reply->comment->post->title }}</a></td>
                        <td>{{ $reply->user->name }}</td>
                        <td>{{ str_limit($reply->body, 17) }}</td>
                        <td><a href="{{ route('admin.comments.show', $reply->comment->post_id) }}">View parent comment</a></td>

                        @if ($reply->is_active == 0) 
                            
                            <td>    
                                {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                                    {!! Form::hidden('is_active', '1') !!}
                                    {!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                            </td>
                        @else
                            <td> 
                                {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                                    {!! Form::hidden('is_active', '0') !!}
                                    {!! Form::submit('Inappropriate', ['class' => 'btn btn-warning']) !!}
                                {!! Form::close() !!}
                            </td>
                        @endif
                        <td> 
                            {!! Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]]) !!}
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