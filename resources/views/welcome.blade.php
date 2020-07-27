@extends('layouts.app')
@section('content')
<div style="background-color:rgb(0,0,0,0.2); border-radius:25px;" class="w-50 p-5 mx-auto">

<div class="container">
    <div class="row">
        <div class="mx-auto text-middle">
            <h1 class="text-white">Welcome to <span class="text-warning">DinoDiary</span></h1>
        </div>
    </div>
<div class="row">
    <div class="col-md-6 col-sm-12 mt-3 text-white">
        <img class="float-left" src="https://img.icons8.com/ultraviolet/80/000000/magazine.png"/>
        <span class="h5">Write your own personal diary to your account for free!</span>
    </div>
    <div class="col-md-6 col-sm-12 mt-3 text-white">
        <img class="float-left" src="https://img.icons8.com/ultraviolet/80/000000/laptop.png"/>
        <p class="h5">Writing diaries online can be more secure than keeping a personal journal at home in your notebook.</p>
    </div>
    </div>

<div class="row">
    <div class="text-white mt-5 mx-auto">
        <p class="h5">Join us now by signing up!</p>
        <img class="d-block mx-auto pb-2" src="https://img.icons8.com/ultraviolet/80/000000/add-user-male.png"/>
        <a href="{{ url('/login') }}" class="btn btn-outline-light ml-5">Get Started!</a>
    </div>
</div>
  </div>
</div>
@endsection