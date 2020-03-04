@extends('layouts.app')

@section('content')
    <h1 class="ml-2">{{ $user->name }}</h1>
    <form action="/questionary/sports" method="POST">
        <div class="form-check">
            @foreach($sportcolumns as $sportKey => $sportValue)
                @if($sportKey < 2 || $sportKey > count($sportcolumns)-3)
                    @continue
                @endif
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck{{ $sportKey }}" name="sports[]" value="{{ $sportValue }}"
                        {{ $user->sport[$sportValue] == true ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customCheck{{ $sportKey }}">{{ $sportValue }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary my-2 ml-3">Submit</button>
        @csrf
    </form>


    <div class="container">
        <div class="row hidden-md-up">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Card title</h4>
                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                        <p class="card-text p-y-1">Some quick example text to build on the card title .</p>
                        <a href="#" class="card-link">link</a>
                        <a href="#" class="card-link">Second link</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Card title</h4>
                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                        <p class="card-text p-y-1">Some quick example text to build on the card title .</p>
                        <a href="#" class="card-link">link</a>
                        <a href="#" class="card-link">Second link</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Card title</h4>
                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                        <p class="card-text p-y-1">Some quick example text to build on the card title .</p>
                        <a href="#" class="card-link">link</a>
                        <a href="#" class="card-link">Second link</a>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Card title</h4>
                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                        <p class="card-text p-y-1">Some quick example text to build on the card title .</p>
                        <a href="#" class="card-link">link</a>
                        <a href="#" class="card-link">Second link</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Card title</h4>
                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                        <p class="card-text p-y-1">Some quick example text to build on the card title .</p>
                        <a href="#" class="card-link">link</a>
                        <a href="#" class="card-link">Second link</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Card title</h4>
                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                        <p class="card-text p-y-1">Some quick example text to build on the card title .</p>
                        <a href="#" class="card-link">link</a>
                        <a href="#" class="card-link">Second link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
