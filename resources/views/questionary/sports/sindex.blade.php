@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/questionary/sports" method="POST">
            <div class="form-check">
                <div class="row">
                    @foreach($sportcolumns as $sportKey => $sportValue)
                        @if($sportKey < 2 || $sportKey > count($sportcolumns)-3)
                            @continue
                        @endif
                            <div class="col-md-4 my-3">
                                @if($user->sport[$sportValue])
                                <div class="container" data-aos="fade-up">
                                    <div class="card zoom" style="border-color: #2d995b; border-width: 1.4px; color: #2d995b">
                                @else
                                <div class="container" data-aos="fade-up">
                                    <div class="card zoom ">
                                @endif
                                        <img class="card-img-top img-fluid" style="height: 225px; width: 100%; display: block;" src="{{ url('images/sports/'.$sportValue.'.png') }}" alt="Card image cap">
                                        <div class="card-block text-center">
                                            <h4 class="card-title"><b>{{ ucfirst($sportValue) }}</b></h4>
                                            <p class="card-text">If this is a sport you like press button below</p>
                                            <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                                <label class="btn btn-outline-quest active">
                                                    <input type="checkbox" name="sports[]" id="customCheck{{ $sportKey }}"
                                                           value="{{ $sportValue }}" {{ $user->sport[$sportValue] ? 'checked' : '' }}>
                                                            {{ $user->sport[$sportValue] ? 'Uncheck' : 'Check'}}
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
