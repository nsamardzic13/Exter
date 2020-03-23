<div class="form-group">
    <label for='time-start'>Start time:</label>
    <input type="time" name="time-start"  id="start-time" value="{{ old('time-start')}}" class="form-control">
</div>
<div>{{ $errors->first('time-start') }}</div>
<div class="form-group">
    <label for='time-end'>End time:</label>
    <input type="time" name="time-end"  value="{{ old('time-end')}}"  class="form-control">
</div>
<div>{{ $errors->first('time-end') }}</div>
<p>Repeat on these days</p>

<div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
    @foreach ($days as $day => $dayValue)
        <label class="btn btn-outline-quest col-auto px-4">
            <input type="checkbox" name="day"
                   value=" {{$day}}" >
            {{ $dayValue}}
        </label>
    @endforeach
</div>
<div>{{ $errors->first('day') }}</div>
