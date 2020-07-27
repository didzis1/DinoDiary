@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="container text-center pt-3">
                    <h2>It's {{ $day }}.</h2>
                    <h4>How are you doing today {{ Auth::user()->name }}?</h4>
                </div>
                <hr>
                <p class="text-center h5">Thus far you have written {{ $userPostsCount }} posts in your Journal.</p>
                <p class="text-center h5">Good Job!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
