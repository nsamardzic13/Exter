@extends('layouts.app')

@section('content')
    @if(Auth::user())
        @if(!Auth::user()->hasVerifiedEmail())
            <div class="alert-danger text-center" style="border-width: 2px;height: 28px; border-color: #E32743">
                <strong class="ml-5">Verify your mail</strong> to start using the page<b> !</b>
            </div>
        @endif
    @endif

<div class="wrapper pt-10">
   <div class="content container">
       <div class="row align-items-center" data-aos="fade-up" data-aos-delay="50">
           <div class="col-lg-6 landing-text">
               <h1 class="mb-1">Welcome to exter</h1>
               <p>Bored at home and have nothing to do?</p>
               <p class="mb-4">Explore, make and go to events alone or with group of friends!</p>
                @if(Auth::guest())
                   <a href="/login" class="btn btn-outline-quest rounded-pill zoom">Login</a>
                   <a href="/register" class="btn btn-outline-quest rounded-pill zoom" style="margin-left: 7px">Register</a>
                   <div class="mt-3">
                       <a href="{{ url('/auth/redirect/google') }}" class="btn btn-outline-quest rounded-pill zoom"><i class="fab fa-google"></i>
                           &nbsp&nbsp&nbsp Sign in with <b>Google</b></a>
                   </div>
                @endif
               @if(!Auth::guest())
               <a href="/events" class="btn btn-outline-quest rounded-pill zoom my-1 mx-1"><i class="fas fa-search"></i> See events near you</a>
               <a href="/events/create" class="btn btn-outline-quest2 rounded-pill zoom mt-1 mx-1"><i class="fas fa-edit"></i> Make new event!</a>
               @endif
           </div>
           <div class="col-lg-6 landing-image" data-aos="fade-up">
               <img src="{{ asset('images/landing/having-fun2.svg') }}" style="height: 330px; width: 100%; margin-bottom: 100px">
           </div>
       </div>
   </div>
</div>
<div class="container py-10">
    <div class="row text-center">
        <div class="col-lg-4 mb-5 mb-lg-0 zoom">
            <div class="icon-stack mb-3"><i class="fas fa-campground"></i></div>
            <h4>Want to go out more?</h4>
            <p>Hard time finding what do you want to do? Dont worry exter has your back.</p>
        </div>
        <div class="col-lg-4 mb-5 mb-lg-0 zoom">
            <div class="icon-stack mb-3"><i class="fas fa-search-location"></i></div>
            <h4>Want to find cool events?</h4>
            <p>Explore events on our site tailored by your wishes. Join group of friends and off you go to new adventure.</p>
        </div>
        <div class="col-lg-4 mb-5 mb-lg-0 zoom">
            <div class="icon-stack mb-3"><i class="fas fa-lightbulb"></i></div>
            <h4>Want to make a cool event?</h4>
            <p>Have idea for cool event, or just trying to find partner for a game of chess. Make event and just wait till someone joins :)</p>
        </div>
    </div>
</div>

@endsection
