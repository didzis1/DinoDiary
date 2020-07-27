@extends('layouts.app')

@section('content')

<div class="w-50 mx-auto">
<a href="{{ url('/posts') }}" class="btn btn-outline-dark btn-light float-left">Go Back</a>
</div>
<br>
<div class="container text-center pt-3 w-50">
    <h3 style="display:inline-block;">My Diary</h3>
    </div>

<div class="card pt-3 mx-auto card-body w-50 mt-4">
    @if($post->image == 'noimg.jpg')

    @else
    <img style="width:100%" src="{{ url('storage/uploaded_images/'.$post->image) }}" alt="">
    <hr>
    @endif
    
    <div class="card-header">
        <h2>{{ $post->title }}</h2>
    </div>
    <div class="card-body">
        <p>{!! $post->body !!}</p>
    </div>
    <hr>
        <small class="pl-3">{{ $post->created_at }}</small>

        <div class="btn-toolbar mt-3">
            <div class="btn-group ml-2">
                <a href="{{ url('/') }}/posts/{{ $post->id }}/edit" class="btn btn-success">Edit</a>
            </div>
            <div class="btn-group ml-3">
                {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE']) !!}
                {{ Form::submit('Delete Post', ['class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
            </div>
        </div>


    </div>
@endsection