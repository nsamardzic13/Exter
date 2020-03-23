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



                <div class="container-fluid d-inline-block px-4 ">
                    @if(!$occasions->isEmpty())
                        <div class="row">
                            @foreach($occasions as $eventNmb => $event)
                                <div class="col-md-3 my-4" data-aos="fade-up">
                                    <div class="card zoom" style="border-color: #2d995b; border-width: 1.4px; color: #2d995b">
                                        <img class="card-img-top img-fluid" style="height: 225px; width: 100%; display: block;" src="{{ url('images/hangout-sports/'.$event->category.'.png') }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $event->name }}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{{ date('d.m.Y h:i', strtotime($event->start))}}</h6>
                                            <h6 class="card-subtitle mb-2 text-muted">{{ $event->category }}</h6>
                                            <h6 class="card-subtitle mb-2 text-muted">{{ $event->user_name }}</h6>
                                            <p class="card-text">{{ $event->description }}</p>
                                            <button type="button" class="btn btn-outline-success btn-lg my-2 ml-4 center-block" data-toggle="modal" data-target="#myModal{{$event->id}}">Open</button>

                                        </div>
                                    </div>
                                </div>
                                @include('occasions.show',  ['occasion' => $event])
                            @endforeach
                        </div>
                </div>
                @else
                    <div class="container-fluid ">
                        <p class="mx-auto">There are no more upcoming events</p>
                    </div>
                @endif

                {{ $occasions->links() }}
            </div>

            <br>
            <div class="container-fluid p-5">
                <a href="/events/create" class="container-fluid btn btn-outline-success btn-lg bg-light">Add new</a>

            </div>

        </div>
    </div>
    </div>
@endsection
