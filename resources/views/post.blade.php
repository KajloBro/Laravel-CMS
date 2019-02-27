@extends('layouts.blog-post')

@section('content')

<!-- Title -->
<h1>{{ $post->title }}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{ $post->user->name }}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans() }}</p>

<hr>

<!-- Preview Image -->
<img class="img50" src="{{ $post->photo->path }}" alt="">

<hr>

<!-- Post Content -->
<p>{!! $post->body !!}</p>
<hr>

<!-- Blog Comments -->

@if (Auth::check())

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        
        {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}

            <div class="form-group">
                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '5']) !!}
            </div>

            {!! Form::hidden('post_id', $post->id) !!}

            <div class="form-group">
                {!! Form::submit('Comment', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

    </div>

    <hr>

@endif
<!-- Posted Comments -->

<!-- Comment -->

@if (count($comments))

    @foreach ($comments as $comment)
        
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object img50"  src="{{ $comment->user->photo->path }}" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{ $comment->user->name }}
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </h4>
                <p>{{ $comment->body }}</p>
                
                {{-- Nest --}}
                @if (count($comment->replies))
                    <button class="btn btn-link toggle-replies">Toggle {{ count($comment->replies) }} comments</button>
                    <div id="replies" class="hide-this">
                        @foreach ($comment->replies as $reply)
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img30"  src="{{ $reply->user->photo->path }}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $reply->user->name }}
                                        <small>{{ $reply->created_at->diffForHumans() }}</small>
                                    </h4>
                                    <p>{{ $reply->is_active ? $reply->body : "This comment is marked as inappropriate" }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                   

                @endif
                {{-- Nest end --}}
                <button class="btn btn-link toggle-reply-form">Reply</button>
                <div class="reply-form hide-this">
                    {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}
                        <div class="form-group mt-1">
                                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => "1"]) !!}
                                {!! Form::hidden('comment_id', $comment->id) !!}
                                {!! Form::submit('Reply', ['class' => 'btn btn-primary mt-1']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @endforeach

@endif

</div>

    
@endsection

@section('scripts')

     <script>
         $('.toggle-replies').click(function() {
            $(this).next().fadeToggle('slow');
         });
         $('.toggle-reply-form').click(function() {
            $(this).next().fadeToggle('slow');
         });
     </script>
    
@endsection