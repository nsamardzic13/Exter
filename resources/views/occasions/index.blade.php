@extends('layouts.app')

@section('content')
<div class="container-fluid p-5 jumbotron jumbotron-fluid bg-gradient-primary-to-secondary">
    <div class="row justify-content-center">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="container justify-content-center pb-5 pr-5">
                <h1 class=" text-white">Upcoming events</h1>
                
            </div>


            
                <div class="card p-3 d-inline-block">
                    @if(!$occasions->isEmpty())
                    @foreach ($occasions as $event)
                    
                    <div class="d-inline-block justify-content-center">
                        <div class="container p-2 d-inline-block justify-content-center">
                            <div class="card zoom" style="width: 18rem">
                               <img class="card-img-top img-fluid" style="height: 225px; width: 100%; display: block;" src="{{ url('images/hangout-sports/'.$event->category.'.png') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->name }}</h5>                                
                                    <h6 class="card-subtitle mb-2 text-muted">{{ date('d.m.Y h:m', strtotime($event->start))}}</h6>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $event->category }}</h6>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/events/{{ $event->id }}" class="btn btn-outline-success btn-lg my-2 ml-4">Open</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="container-fluid ">
                        <p class="mx-auto">There are no more upcoming events</p>
                    </div>
                    @endif
                
            </div>
         
           <br>
           <div class="container-fluid p-5">
            <a href="/events/create" class="container-fluid btn btn-outline-success btn-lg bg-light">Add new</a>
               
           </div>

        </div>
    </div>
</div>
@endsection
