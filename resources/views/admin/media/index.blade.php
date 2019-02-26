@extends('layouts.admin')

@section('content')

    <h1>Media</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Picture</th>
                <th>Path</th>
            </tr>
        </thead>
        <tbody>
            @if ($photos)

                @foreach ($photos as $photo)

                    <tr>
                        <td>{{ $photo->id }}</td>
                        <td><img class="img50" src="{{ $photo->path }}" alt="http://placehold.it/400x400"></td>
                        <td>{{ $photo->path }}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediasController@destroy', $photo->id]]) !!}
                                <div class="form-group">
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    
                @endforeach
                
            @endif
        </tbody>
    </table>
    
@endsection