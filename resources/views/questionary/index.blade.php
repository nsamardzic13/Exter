@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid bg-gradient-primary-to-secondary">
        <div class="container text-center">
            <h1 class="display-4" style="color: whitesmoke">Questionary</h1>
            <p class="lead" style="font-weight: revert; color: #343a40">Pick some of your favourite sports, and when and how you like to spend your free time</p>
            <img src="{{ asset('images/quest/check.png') }}" style="height: 150px; width: 430px;">
            <hr>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success" role="alert" style="border-width: 1px; border-color: #27864f">
            <strong>Success</strong> {{ session()->get('message') }}
        </div>
    @endif

    <div class="album bg-light mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow zoom">
                        <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="{{asset('images/quest/sport.png')}}">
                        <div class="card-body">
                            <p class="card-text">
                                <b>Pick what sports you like!</b>
                            </p>
                            <div class="align-items-center">
                                <p class="text-center">
                                    <a href="/questionary/sports"><button type="button" style="background-color: #FF8663;" class="btn btn-outline-danger btn-lg"><b>Pick <i class="fas fa-futbol"></i></b></button></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow zoom">
                        <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="{{asset('images/quest/hangout.png')}}">
                        <div class="card-body">
                            <p class="card-text">
                                <b>Pick what type of hangouts you like the most!</b>
                            </p>
                            <div class="align-items-center">
                                <p class="text-center">
                                    <a href="/questionary/hangouts"><button type="button" style="background-color: #FF8663;" class="btn btn-outline-danger btn-lg"><b>Pick </b><i class="fas fa-handshake"></i></button></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow zoom">
                        <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="{{asset('images/quest/availability.png')}}">
                        <div class="card-body">
                            <p class="card-text">
                                <b>Pick in what time you like doing things!</b>
                            </p>
                            <div class="align-items-center">
                                <p class="text-center">
                                    <a href="/questionary/availability"><button type="button" style="background-color: #FF8663;" class="btn btn-outline-danger btn-lg"><b>Pick </b><i class="fas fa-user-clock"></i></button></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

