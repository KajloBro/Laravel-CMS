@extends('layouts.admin')

@section('content')

    <h1>Posts</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Photo</th>
                <th>Category</th>
                <th>Title</th>
                <th>Body</th>
                <th>Comments</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>   
        </thead>
        <tbody>
            @if ( $posts )
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            @if ($post->user_id)
                                <a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->user->name }}</a>
                            @endif
                        </td>
                        <td>
                            @if ($post->photo_id)
                                <img height="30" src="{{ $post->photo->path }}" alt="">
                            @endif
                        </td>
                        <td>
                            @if ($post->category)
                                {{ $post->category->name }}
                            @else
                                Uncategorized
                            @endif
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ str_limit($post->body, 7) }}</td>
                        <td><a href="{{ route('admin.comments.show', $post->id) }}">Comments</a></td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    
@endsection