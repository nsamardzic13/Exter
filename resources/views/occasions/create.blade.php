@extends('layouts.app')
<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
?>
@section('content')


<div class="container-fluid p-5 jumbotron jumbotron-fluid bg-gradient-primary-to-secondary">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Create event</h1>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="row">
                        <div class="col-12">

                            @if($user)
                            <form action="/events" method="POST" class="pb-2">
                                <div class="form-group">
                                    <label for='name'>Name:</label>
                                    <input type="text" name="name" value="{{ old('name')}}" class="form-control">
                                </div>
                                <div>{{ $errors->first('name') }}</div>

                                <div class="form-group">
                                    <label for='street'>Street:</label>
                                    <input type="text" name="street"  value="{{ old('street')}}" class="form-control">
                                </div>
                                <div>{{ $errors->first('street') }}</div>

                                <div class="form-group">
                                    <label for='city'>City:</label>
                                    <input type="text" name="city"  value="{{ old('city')}}" class="form-control">
                                </div>
                                <div>{{ $errors->first('city') }}</div>

                                <div class="form-group">
                                    <label for='zipcode'>Zipcode:</label>
                                    <input type="text" name="zipcode"  value="{{ old('zipcode')}}" class="form-control">
                                </div>
                                <div>{{ $errors->first('zipcode') }}</div>

                               
                                <div class="form-group">
                                    <label for='start'>Start:</label>
                                    <input type="datetime-local" name="start"  value="{{ old('start')}}" class="form-control">
                                </div>
                                <div>{{ $errors->first('start') }}</div>

                                <div class="form-group">
                                    <label for='end'>End:</label>
                                    <input type="datetime-local" name="end"  value="{{ old('end')}}" class="form-control">
                                </div>
                                <div>{{ $errors->first('end') }}</div>

                                 <div class="form-group">
                                    <label for='max_people'>Maximum number of people:</label>
                                    <input type="number" name="max_people"  value="{{ old('max_people')}}" class="form-control">
                                </div>
                                <div>{{ $errors->first('max_people') }}</div>

                                <div class="form-group">
                                    <label for="category"></label>
                                    <select name ="category" class="form-control">
                                        <option value="" disabled="" selected>Select category</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c }}">{{ $c }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-outline-success btn-lg my-2 ml-4">Add event</button>
                                @csrf

                                    
                            @else
                            <p>You need to login</p>
                            @endif

                            </form>
                        </div>
                    </div>
                    <p><a href="/events">Back</a></p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
