@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h1>Details</h1>

            <div class="row">
                <div class="col-12">
                    <p><strong>Name:</strong> {{ $occasion->name }}</p>
                    <p><strong>Street:</strong> {{ $occasion->street }}</p>
                    <p><strong>City:</strong> {{ $occasion->city }}</p>
                    <p><strong>Zipcode:</strong> {{ $occasion->zipcode }}</p>
                    <p><strong>Start:</strong> {{ $occasion->start }}</p>
                    <p><strong>End:</strong> {{ $occasion->end }}</p>
                    <p><strong>Category:</strong> {{ $occasion->category }}</p>
                    <p><strong>Host:</strong> {{ $occasion->user->name }}</p>
                    <p><strong>Max people:</strong> {{ $occasion->max_people }}</p>
                    <p><strong>Status:</strong> {{ $occasion->ended }}</p>
                    
                </div>
            </div>

            <p><a href="/events">Back</a></p>
        </div>
       
    </div>
</div>

@endsection

