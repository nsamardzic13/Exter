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
            <div class="container justify-content-center pb-2 pr-5">
                <h1 class="text-white font-weight-bolder">Create event</h1></br>
            </div>
        <div class="card" >
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @auth
                            <form action="/events" method="POST" class="pb-2">

                                <label class="text-secondary" for='name'>Name:</label>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-muted bg-light"><i class="fas fa-signature"></i></span>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name', $event->name ?? '')}}" class="form-control" >
                                </div>
                                <div class="text-danger pb-3">{{ $errors->first('name') }}</div>

                                 <label class="text-secondary" for='street'>Street:</label>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-muted bg-light" ><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" name="street" id="event_address" value="{{ old('street', $event->street ?? '')}}" class="form-control" >
                                </div>
                                <div class="text-danger pb-3">{{ $errors->first('street') }}</div>

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
                                     <label class="text-secondary"for='start-one'>Start date:</label>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-muted bg-light" ><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="start-one"  @if(!old('start-one', $event->start ?? '')) value="{{date("Y-m-d", strtotime('tomorrow'))}}"
                                                                            @else value ="{{old('start-one', date('Y-m-d', strtotime($event->start ?? '')))}}" @endif  class="form-control">
                                    </div>
                                    <div class="text-danger pb-3">{{ $errors->first('start-one') }}</div>


                                     <label class="text-secondary"for='end-one'>End date:</label>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-muted bg-light" ><i class="fas fa-calendar"></i></span>
                                        </div>
                                    <input type="date" name="end-one"  @if(!old('end-one', $event->start ?? '')) value="{{date("Y-m-d", strtotime('tomorrow'))}}"  @else value ="{{old('end-one', date('Y-m-d', strtotime($event->end ?? ''))) }}" @endif class="form-control">
                                    </div>
                                    <div class="text-danger pb-3">{{ $errors->first('end-one') }}</div>
                                    <div class="container border p-2">
                                        <div class="pb-3">
                                            <p class="title">Event time:</p>
                                             <label class="text-secondary"for='time-start-one'>Start time:</label>
                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text text-muted bg-light" ><i class="fas fa-clock"></i></span>
                                                </div>
                                                <input type="time" name="time-start-one" @if(!old('time-start-one', $event->start ?? '' )) value="{{date('H:i')}}"  @else value ="{{old('time-start-one', date('H:i', strtotime($event->start ?? '')) )}}" @endif class="form-control">
                                            </div>
                                            <div class="text-danger pb-3">{{ $errors->first('time-start-one') }}</div>
                                             <label class="text-secondary"for='time-end'>End time:</label>
                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text text-muted bg-light" ><i class="fas fa-clock"></i></span>
                                                </div>
                                                <input type="time" name="time-end-one"  @if(!old('time-end-one', $event->start ?? '')) value="{{date('H:i', strtotime("+1 hours"))}}"  @else value ="{{old('time-end-one', date('H:i', strtotime($event->end ?? '')))}}" @endif class="form-control">
                                            </div>
                                            <div class="text-danger pb-3">{{ $errors->first('time-end-one') }}</div>
                                        </div>
                                    </div>
                                </div>


                                <div id="days" @if(old('when')) style="display:initial" @else style="display:none" @endif>
                                     <label class="text-secondary"for='start'>Start from:</label>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-muted bg-light" ><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="start"  @if(!old('start', $event->start ?? '')) value="{{date("Y-m-d", strtotime('tomorrow'))}}"  @else value ="{{old('start', date('Y-m-d', strtotime($event->start ?? '')))}}" @endif class="form-control">
                                    </div>

                                    <div class="text-danger pb-3">{{ $errors->first('start') }}</div>


                                     <label class="text-secondary"for='repeat'>Repeat:</label>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text text-muted bg-light" ><i class="fas fa-redo-alt"></i></span>
                                            </div>
                                            <select name ="repeat" class="form-control">
                                            <option value="7" selected>For a week</option>
                                            <option value="14" >For 2 weeks</option>
                                            <option value="21" >For 3 weeks</option>
                                            <option value="28" >For 4 weeks</option></select>
                                        </div>
                                    <div class="text-danger pb-3">{{ $errors->first('repeat') }}</div>

                                    <h4>Time:</h4>
                                    <div id="time" class="container border p-2">

                                    @include('occasions.time', [$days, 'event' => $event ?? new \App\Occasion()])

                                    </div>

                                    <div class="form-group">
                                        <div class="btn btn-secondary btn-lg" id="addtime">Add new time</div>
                                        <div class="btn btn-secondary btn-lg" id="removetime">Remove time</div>
                                    </div>
                                </div>
                                <br><br>
                                 <label class="text-secondary"for='max_people'>Maximum number of people:</label>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-muted bg-light" ><i class="fas fa-user-friends"></i></span>
                                        </div>
                                        <input type="number" name="max_people"  value="{{ old('max_people', $event->max_people ?? '')}}" class="form-control">
                                    </div>
                                <div class="text-danger pb-3">{{ $errors->first('max_people') }}</div>

                                 <label class="text-secondary"for='description'>Description:</label>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-muted bg-light" ><i class="fas fa-align-center"></i></span>
                                        </div>
                                        <textarea type="text" class="form-control" name="description" rows="3">{{ old('description', $event->description ?? '')}} </textarea>
                                    </div>
                                <div class="text-danger pb-3">{{ $errors->first('description') }}</div>


                                 <label class="text-secondary"for="category"></label>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-muted bg-light" ><i class="fas fa-th-list"></i></span>
                                    </div>
                                    <select name ="category" class="form-control">
                                        <option value="" disabled="" selected>Select category</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c }}" {{ old('category', $event->category ?? '') == $c ? 'selected' : '' }}>{{ $c }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-danger pb-3">{{ $errors->first('category') }}</div>

                                <button type="submit" class="btn btn-outline-success btn-lg my-2 ml-4 px-5">Add event</button>
                                @csrf

                            </form>
                        @endauth
                        @guest
                                <div class="container-fluid card p-5 ">
                                    <p class="mx-auto text-orange font-weight-bolder">You need to login to create an event</p>
                                </div>
                        @endguest
                        <div>
                            <p class="float-right "><a href="/events"><button type="button" class="btn btn-secondary btn-lg my-2 ml-4 px-4">Back</button></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
