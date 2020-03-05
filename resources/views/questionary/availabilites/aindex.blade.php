@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/questionary/availability" method="POST">
            <div class="form-check">
                <div class="row">
                    @foreach($availabilitycolumns as $avaiKey => $avaiValue)
                        @if($avaiKey < 2 || $avaiKey > count($availabilitycolumns)-3)
                            @continue
                        @endif
                        <div class="col-md-4 my-3">
                            @if($user->availability[$avaiValue])
                                <div class="container" data-aos="fade-up">
                                    <div class="card zoom" style="border-color: #2d995b; border-width: 1.4px; color: #2d995b">
                                        @else
                                            <div class="container" data-aos="fade-up">
                                                <div class="card zoom ">
                                                    @endif
                                                    <img class="card-img-top img-fluid" style="height: 225px; width: 100%; display: block;" src="{{ url('images/availability/'.$avaiValue.'.png') }}" alt="Card image cap">
                                                    <div class="card-block text-center">
                                                        <h4 class="card-title"><b>{{ ucfirst($avaiValue) }}</b></h4>
                                                        <p class="card-text">If this is a time when you like to do things press the button below</p>
                                                        <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                                            <label class="btn btn-outline-quest active">
                                                                <input type="checkbox" name="avai[]" id="customCheck{{ $avaiKey }}"
                                                                       value="{{ $avaiValue}}" {{ $user->availability[$avaiValue] ? 'checked' : '' }}>
                                                                {{ $user->availability[$avaiValue] ? 'Uncheck' : 'Check'}}
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
