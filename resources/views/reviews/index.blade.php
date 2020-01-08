@extends('layouts.app')
@section('content')
        <h1>Reviews</h1> 
        @if(count($reviews) > 0)
        @foreach($reviews as $review)
            
                <div class="row">
                    <div>
                    </div>
                    <div>
                        <h3><a href="/reviews/{{$review->id}}">{{$review->title}}</a></h3>
                        <small>Written on {{$review->created_at}}</small>
                    </div>
                </div>
            
        @endforeach
        {{$reviews->links()}}
    @else
        <p>No reviews found</p>
    @endif
@endsection