@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$occasion->name}}</h1>
        <p>neki wall eventa</p>

        <p>joinani useri:</p>
        @foreach($joined as $user)
            <p>{{$user->name}}</p>
            @endforeach
    </div>
@endsection
