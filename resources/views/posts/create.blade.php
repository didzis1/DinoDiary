@extends('layouts.app')

@section('content')

<div class="container text-center pt-3 w-50">
    <h3>Write a new post for your diary</h3>
    </div>

<div class="container">

    {!!  Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{ Form::label('title','Title of your Diary') }}
            {{ Form::text('title','',['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{ Form::label('body','Body text of your Diary') }}
            {{ Form::textarea('body','',['class' => 'form-control','placeholder' => 'Body Text']) }}
        </div>
        <div class="form-group">
            {{ Form::file('image') }}
        </div>
        {!! Form::submit('Create new post', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
    @include('optional.errmessages')
</div>
<script>
    CKEDITOR.replace( 'body' );
</script>
@endsection