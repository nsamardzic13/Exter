@extends('layouts.app')

@section('content')
    <div class="container-fluid p-5 jumbotron jumbotron-fluid bg-gradient-primary-to-secondary">
        <div class="row justify-content-center">
            <div class="card-body">
                <div class="container justify-content-center p4-5 pr-5">
                    <h1 class="text-white font-weight-bolder">Upcoming events</h1></br>
                </div>

                @if(session()->has('message'))
                    <div class="alert alert-success" role="alert" style="border-width: 1px; border-color: #27864f">
                        <strong>Success</strong> {{ session()->get('message') }}
                    </div>
                @endif
                <div class="container-fluid d-inline-block px-4 ">
                    @if(!$occasions->isEmpty())
                        <div class="row">
                            @foreach($occasions as $eventNmb => $event)
                                <div class="col-md-3 my-4" data-aos="fade-up">
                                    <div class="card zoom" style="border-color: #2d995b; border-width: 1.4px; color: #2d995b">
                                        <img class="card-img-top img-fluid" style="height: 225px; width: 100%; display: block;" src="{{ url('images/hangout-sports/'.$event->category.'.png') }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title p-2">{{ $event->name }}</h4>
                                            <h6 class="card-subtitle mb-2 text-muted row"><i class="fas fa-calendar-day col-sm-1"></i><p class="col-sm">{{ date('d.m.Y', strtotime($event->start))}}</p>
                                                                                          <i class="fas fa-clock pl-3 col-sm-1"></i> <p class="col-sm">{{ date('H:i', strtotime($event->start))}}</p></h6>
                                            <h6 class="card-subtitle mb-2 text-muted row"><i class="fas fa-map-marker-alt pr-2 col-sm-1"></i><p class="col-sm-11"> {{ $event->street }}</p></h6>
                                            <h6 class="card-subtitle mb-2 text-muted row"><i class="fas fa-list-alt pr-2 col-sm-1"></i><p class="col-sm-11">{{ $event->category }}</p></h6>
                                            <h6 class="card-subtitle mb-2 text-muted row"><i class="fas fa-user-tie pr-2 col-sm-1"></i><p class="col-sm-11">{{ $event->user_name }}</p></h6>
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
                    <div class="container-fluid card p-5 ">
                        <p class="mx-auto text-orange font-weight-bolder">There are no upcoming events</p>
                        <a href="/events/create" class="btn btn-outline-quest2 btn-lg bg-light">Create one</a>

                    </div>
                @endif

                <div class="container-fluid p-5">
                    <a href="/events/create" class="container-fluid btn btn-outline-quest2 btn-lg bg-light">Add new</a>
                </div>

                {{ $occasions->links() }}
            </div>
        </div>
    </div>
@endsection
