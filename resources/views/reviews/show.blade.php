@extends('layouts.app')

@section('content')
    <a href="/reviews" class="btn btn-default">Go Back</a>
    <h1>{{$review->title}}</h1>
    
    <br><br>
    <div>
        {!!$review->body!!}
    </div>
    <div>
        Review rating = {!!$review->rating!!}
    </div>
    <hr>
    <small>Written on {{$review->created_at}} by </small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $review->user_id)
            <a href="/reviews/{{$review->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['PostsController@destroy', $review->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection