@extends('layouts.app')

@section('content')

<div class="container text-center pt-4">
    @include('optional.errmessages')
    <h3>My Diary</h3>
</div>
<div>
    @if(count($posts)>0)
        @foreach($posts as $post)
        <div class="card pt-3 m-3 card-body mx-auto w-50">
            <div class="row">
                @if($post->image != 'noimg.jpg')
                <div class="col-md-4 col-sm-4">
                    <img style="width:100%" src="{{ url('storage/uploaded_images/'.$post->image) }}" alt="">
                </div>
                <div class="col-md-8 col-sm-8">
                    <h2><a href="{{ url('/') }}/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                    @if(strlen($post->body) > 80) 
                        <p>{!! substr($post->body, 0, 80) . '...' !!}</p>
                    @else
                        <p>{!! $post->body !!}</p>
                    @endif
                    <small>{{ $post->created_at }}</small>
                </div>
                @else
                <div class="col-md-12 col-sm-12">
                    <h2><a href="{{ url('/') }}/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                    @if(strlen($post->body) > 80) 
                        <p>{!! substr($post->body, 0, 80) . '...' !!}</p>
                    @else
                        <p>{!! $post->body !!}</p>
                    @endif
                    <small>{{ $post->created_at }}</small>
                </div>
                @endif
                </div>
        </div>
        @endforeach 
        <div class="mx-auto w-50">
            {{ $posts->links() }}
        </div> 
        
    @else
    <!-- Jos päiväkirjasta ei löydy postauksia -->
        <div class="card-pt-3 m-3 card-body mx-auto w-50 text-center">
            <p>There are no diaries found... Click <a href="{{ url('/posts/create') }}">here</a> to write your first diary!</p>
        </div>
    @endif
</div>
@endsection