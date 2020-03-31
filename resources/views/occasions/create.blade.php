@extends('layouts.app')
<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();

date_default_timezone_set('Europe/Zagreb');
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

                        <div class="row">
                            <div class="col-12">

                                @if($user)
                                    <form action="/events" method="POST" class="pb-2">
                                        <div class="form-group ">
                                            <label for='name'>Name:</label>
                                            <input type="text" name="name" value="{{ old('name')}}" class="form-control">
                                        </div>
                                        <div class="text-danger pb-3">{{ $errors->first('name') }}</div>

                                        <div class="form-group">
                                            <label for='street'>Street:</label>
                                            <input type="text" name="street"  value="{{ old('street')}}" class="form-control" placeholder="{{$user->street_name}}">
                                        </div>

                                        <div class="text-danger pb-3">{{ $errors->first('street') }}</div>

                                        <div class="form-group">
                                            <label for='city'>City:</label>
                                            <input type="text" name="city"  value="{{ old('city')}}" class="form-control">
                                        </div>
                                        <div class="text-danger pb-3">{{ $errors->first('city') }}</div>

                                        <div class="form-group">
                                            <label for='zipcode'>Zipcode:</label>
                                            <input type="text" name="zipcode"  value="{{ old('zipcode')}}" class="form-control">
                                        </div>
                                        <div class="text-danger pb-3">{{ $errors->first('zipcode') }}</div>

                                        <div class="form-group">
                                            <p>When?</p>
                                            <div class="btn-group-toggle mb-2 px-5 row" data-toggle="buttons">
                                                <label class="btn btn-outline-quest col">
                                                    <input type="radio"  id="hideDays" name="when" value="0"  @if(!old('when')) checked @endif />
                                                    Just one time on certain date
                                                </label>
                                                <label class="btn btn-outline-quest col">
                                                    <input type="radio"  id="hideDate" name="when" value="1" @if(old('when')) checked @endif/>
                                                    Repeat on specified days
                                                </label>

                                            </div>
                                            <div>{{ $errors->first('when') }}</div>
                                            <div id="date"  @if(!old('when')) style="display:initial" @else style="display:none" @endif>
                                                <div class="form-group">
                                                    <label for='start-one'>Start date:</label>
                                                    <input type="date" name="start-one"  @if(!old('start-one')) value="{{date("Y-m-d", strtotime('tomorrow'))}}"  @else value ="{{old('start-one')}}" @endif  class="form-control">
                                                </div>
                                                <div class="text-danger pb-3">{{ $errors->first('start-one') }}</div>


                                                <div class="form-group">
                                                    <label for='end-one'>End date:</label>
                                                    <input type="date" name="end-one"  @if(!old('end-one')) value="{{date("Y-m-d", strtotime('tomorrow'))}}"  @else value ="{{old('end-one')}}" @endif class="form-control">
                                                </div>
                                                <div class="text-danger pb-3">{{ $errors->first('end-one') }}</div>
                                                <div class="container border p-2">
                                                    <div id= class="pb-5">
                                                        <p class="title">Event time:</p>
                                                        <div class="form-group">
                                                            <label for='time-start-one'>Start time:</label>
                                                            <input type="time" name="time-start-one" @if(!old('time-start-one')) value="{{date('H:i')}}"  @else value ="{{old('time-start-one')}}" @endif class="form-control">
                                                        </div>
                                                        <div class="text-danger pb-3">{{ $errors->first('time-start-one') }}</div>
                                                        <div class="form-group">
                                                            <label for='time-end'>End time:</label>
                                                            <input type="time" name="time-end-one"  @if(!old('time-end-one')) value="{{date('H:i', strtotime("+1 hours"))}}"  @else value ="{{old('time-end-one')}}" @endif class="form-control">
                                                        </div>
                                                        <div class="text-danger pb-3">{{ $errors->first('time-end-one') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="days" @if(old('when')) style="display:initial" @else style="display:none" @endif>
                                                <div class="form-group">
                                                    <label for='start'>Start from:</label>
                                                    <input type="date" name="start"  @if(!old('start')) value="{{date("Y-m-d", strtotime('tomorrow'))}}"  @else value ="{{old('start')}}" @endif class="form-control">
                                                </div>

                                                <div class="text-danger pb-3">{{ $errors->first('start') }}</div>


                                                <div class="form-group">
                                                    <label for='repeat'>Repeat:</label>
                                                    <select name ="repeat" class="form-control">
                                                        <option value="7" selected>For a week</option>
                                                        <option value="14" >For 2 weeks</option>
                                                        <option value="21" >For 3 weeks</option>
                                                        <option value="28" >For 4 weeks</option></select>
                                                </div>
                                                <div class="text-danger pb-3">{{ $errors->first('repeat') }}</div>

                                                <h4>Time:</h4>
                                                <div id="time" class="container border p-2">

                                                        @include('occasions.time', $days)


                                                </div>

                                                <div class="form-group">
                                                    <div class="btn btn-secondary btn-lg" id="addtime">Add new time</div>
                                                    <div class="btn btn-secondary btn-lg" id="removetime">Remove time</div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for='max_people'>Maximum number of people:</label>
                                                <input type="number" name="max_people"  value="{{ old('max_people')}}" class="form-control">
                                            </div>
                                            <div class="text-danger pb-3">{{ $errors->first('max_people') }}</div>
                                            <div class="form-group">
                                                <label for='description'>Description:</label>
                                                <textarea type="text" class="form-control" name="description" rows="3">{{ old('description')}} </textarea>
                                            </div>
                                            <div class="text-danger pb-3">{{ $errors->first('description') }}</div>


                                            <div class="form-group">
                                                <label for="category"></label>
                                                <select name ="category" class="form-control">
                                                    <option value="" disabled="" selected>Select category</option>
                                                    @foreach ($category as $c)
                                                        <option value="{{ $c }}" {{ old('category') == $c ? 'selected' : '' }}>{{ $c }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="text-danger pb-3">{{ $errors->first('category') }}</div>

                                            <button type="submit" class="btn btn-outline-success btn-lg my-2 ml-4">Add event</button>
                                            @csrf


                                            @else
                                                <p>You need to login</p>
                                        @endif

                                    </form>
                                    <div>
                                        <p class="float-right"><a href="/events"><button type="button" class="btn btn-secondary btn-lg my-2 ml-4">Back</button></a></p>
                                    </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
