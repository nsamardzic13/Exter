@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/questionary/hangouts" method="POST">
            <div class="form-check">
                <div class="row">
                    @foreach($hangoutcolumns as $hangoutKey => $hangoutValue)
                        @if($hangoutKey < 2 || $hangoutKey > count($hangoutcolumns)-3)
                            @continue
                        @endif
                        <div class="col-md-4 my-3">
                            @if($user->hangout[$hangoutValue])
                                <div class="container" data-aos="fade-up">
                                    <div class="card zoom" style="border-color: #2d995b; border-width: 1.4px; color: #2d995b">
                                        @else
                                            <div class="container" data-aos="fade-up">
                                                <div class="card zoom ">
                                                    @endif
                                                    <img class="card-img-top img-fluid" style="height: 225px; width: 100%; display: block;" src="{{ url('images/hangouts/'.$hangoutValue.'.png') }}" alt="Card image cap">
                                                    <div class="card-block text-center">
                                                        <h4 class="card-title"><b>{{ ucfirst($hangoutValue) }}</b></h4>
                                                        <p class="card-text">If you like this activity press the button below</p>
                                                        <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                                            <label class="btn btn-outline-quest active">
                                                                <input type="checkbox" name="hangouts[]" id="customCheck{{ $hangoutKey }}"
                                                                       value="{{ $hangoutValue }}" {{ $user->hangout[$hangoutValue] ? 'checked' : '' }}>
                                                                {{ $user->hangout[$hangoutValue] ? 'Uncheck' : 'Check'}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-success btn-lg my-2 ml-4"><b>Submit</b></button>
                        </div>
            @csrf
        </form>
    </div>
@endsection
