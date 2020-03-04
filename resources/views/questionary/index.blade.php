@extends('layouts.app')

@section('content')
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Questionary</h1>
                <p class="lead text-muted">
                    neki opis kratki slatki
                </p>
                <p>
                    mozda jos nes
                </p>
            </div>
        </section>
        <div class="album py-4 bg-light">
            <div class="container">
                <div class="row">

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="{{asset('images/sport.png')}}">
                            <div class="card-body">
                                <p class="card-text">
                                    Mozda nesto tu
                                </p>
                                <div class="align-items-center">
                                    <p class="text-center">
                                        <a href="/questionary/sports"><button type="button" style="background-color: #FF8663;" class="btn btn-outline-danger btn-lg"><b>Ispuni</b></button></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="{{asset('images/hangout.png')}}">
                            <div class="card-body">
                                <p class="card-text">
                                    Mozda nesto tu
                                </p>
                                <div class="align-items-center">
                                    <p class="text-center">
                                        <a href="/questionary/hangouts"><button type="button" style="background-color: #FF8663;" class="btn btn-outline-danger btn-lg"><b>Ispuni</b></button></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="{{asset('images/availability.png')}}">
                            <div class="card-body">
                                <p class="card-text">
                                    Mozda nesto tu
                                </p>
                                <div class="align-items-center">
                                    <p class="text-center">
                                        <a href="/questionary/availability"><button type="button" style="background-color: #FF8663;" class="btn btn-outline-danger btn-lg"><b>Ispuni</b></button></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection

