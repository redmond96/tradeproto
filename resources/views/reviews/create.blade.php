@extends('layouts.app')

@section('content')
    <h1>Create Review</h1>
    {!! Form::open(['action' => 'ReviewsController@store', 'method' => 'STORE',]) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('rating', 'Rating from 1 - 5')}}
            {{Form::selectRange('number', 1, 5)}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection