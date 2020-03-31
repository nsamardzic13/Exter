<div class="form-group" style="display: none">
    <input type="number" id="number-times" name="number-times" @if(!old('time-start1')) value="1" @else value ="{{old('number-times')}}" @endif>
</div>
<!---------------------prvi--------------------------->
<div id="time1" class="pb-5 border-bottom p-2">
    <p class="title">Event time:</p>
    <div class="form-group">
        <label for='time-start1'>Start time:</label>
        <input type="time" name="time-start1"  @if(!old('time-start1')) value="{{date('H:i')}}" @else value ="{{old('time-start1')}}" @endif class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-start1') }}</div>

    <div class="form-group">
        <label for='time-end1'>End time:</label>
        <input type="time" name="time-end1"  @if(!old('time-end1')) value="{{date('H:i', strtotime("+1 hours"))}}" @else value ="{{old('time-end1')}}" @endif  class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-end1') }}</div>

    <p>Repeat on these days</p>

    <div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
        @foreach ($days as $day => $dayValue)
            <label class="btn btn-outline-quest col-auto px-4">
                <input type="checkbox" name="day1[]"
                       value=" {{$day}}" @if(old('day1')) @if(in_array($day, old('day1'))) checked @endif @endif>
                {{ $dayValue}}
            </label>

        @endforeach
    </div>
    <div class="text-danger pb-3">{{ $errors->first('day1') }}</div>
</div>

<!---------------------drugi--------------------------->
<div id="time2" class="pb-5 border-bottom p-2" style="display: none">
    <p class="title">Event time:   -2</p>
    <div class="form-group">
        <label for='time-start2'>Start time:</label>
        <input type="time" name="time-start2"  @if(!old('time-start2')) value="{{date('H:i')}}" @else value ="{{old('time-start2')}}" @endif class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-start2') }}</div>

    <div class="form-group">
        <label for='time-end2'>End time:</label>
        <input type="time" name="time-end2"  @if(!old('time-end2')) value="{{date('H:i', strtotime("+1 hours"))}}" @else value ="{{old('time-end2')}}" @endif  class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-end2') }}</div>

    <p>Repeat on these days</p>

    <div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
        @foreach ($days as $day => $dayValue)
            <label class="btn btn-outline-quest col-auto px-6">
                <input type="checkbox" name="day2[]"
                       value=" {{$day}}" @if(old('day2')) @if(in_array($day, old('day2'))) checked @endif @endif>
                {{ $dayValue}}
            </label>
        @endforeach
    </div>
    <div class="text-danger pb-3">{{ $errors->first('day2') }}</div>
</div>



<!---------------------treci--------------------------->
<div id="time3" class="pb-5 border-bottom p-2" style="display: none">
    <p class="title">  Event time: -3</p>
    <div class="form-group">
        <label for='time-start3'>Start time:</label>
        <input type="time" name="time-start3"  @if(!old('time-start3')) value="{{date('H:i')}}" @else value ="{{old('time-start3')}}" @endif class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-start3') }}</div>

    <div class="form-group">
        <label for='time-end3'>End time:</label>
        <input type="time" name="time-end3"  @if(!old('time-end3')) value="{{date('H:i', strtotime("+1 hours"))}}" @else value ="{{old('time-end3')}}" @endif  class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-end3') }}</div>

    <p>Repeat on these days</p>

    <div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
        @foreach ($days as $day => $dayValue)
            <label class="btn btn-outline-quest col-auto px-4">
                <input type="checkbox" name="day3[]"
                       value=" {{$day}}" @if(old('day3')) @if(in_array($day, old('day3'))) checked @endif @endif>
                {{ $dayValue}}
            </label>
        @endforeach
    </div>
    <div class="text-danger pb-3">{{ $errors->first('day3') }}</div>
</div>


<!---------------------cetvrti--------------------------->
<div id="time4" class="pb-5 border-bottom p-2" style="display: none">
    <p class="title">Event time:  -4</p>
    <div class="form-group">
        <label for='time-start4'>Start time:</label>
        <input type="time" name="time-start4"  @if(!old('time-start4')) value="{{date('H:i')}}" @else value ="{{old('time-start4')}}" @endif class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-start4') }}</div>

    <div class="form-group">
        <label for='time-end4'>End time:</label>
        <input type="time" name="time-end4"  @if(!old('time-end4')) value="{{date('H:i', strtotime("+1 hours"))}}" @else value ="{{old('time-end4')}}" @endif  class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-end4') }}</div>

    <p>Repeat on these days</p>

    <div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
        @foreach ($days as $day => $dayValue)
            <label class="btn btn-outline-quest col-auto px-4">
                <input type="checkbox" name="day4[]"
                       value=" {{$day}}" @if(old('day4')) @if(in_array($day, old('day4'))) checked @endif @endif>
                {{ $dayValue}}
            </label>
        @endforeach
    </div>
    <div class="text-danger pb-3">{{ $errors->first('day4') }}</div>
</div>

<!---------------------peti--------------------------->
<div id="time5" class="pb-5 border-bottom p-2" style="display: none">
    <p class="title">Event time: -5</p>
    <div class="form-group">
        <label for='time-start5'>Start time:</label>
        <input type="time" name="time-start5"  @if(!old('time-start5')) value="{{date('H:i')}}" @else value ="{{old('time-start5')}}" @endif class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-start5') }}</div>

    <div class="form-group">
        <label for='time-end5'>End time:</label>
        <input type="time" name="time-end5"  @if(!old('time-end5')) value="{{date('H:i', strtotime("+1 hours"))}}" @else value ="{{old('time-end5')}}" @endif  class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-end5') }}</div>

    <p>Repeat on these days</p>

    <div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
        @foreach ($days as $day => $dayValue)
            <label class="btn btn-outline-quest col-auto px-4">
                <input type="checkbox" name="day5[]"
                       value=" {{$day}}" @if(old('day5')) @if(in_array($day, old('day5'))) checked @endif @endif>
                {{ $dayValue}}
            </label>
        @endforeach
    </div>
    <div class="text-danger pb-3">{{ $errors->first('day5') }}</div>
</div>

<!---------------------sesti--------------------------->
<div id="time6" class="pb-5 border-bottom p-2" style="display: none">
    <p class="title">Event time: -6</p>
    <div class="form-group">
        <label for='time-start6'>Start time:</label>
        <input type="time" name="time-start6"  @if(!old('time-start6')) value="{{date('H:i')}}" @else value ="{{old('time-start6')}}" @endif class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-start6') }}</div>

    <div class="form-group">
        <label for='time-end6'>End time:</label>
        <input type="time" name="time-end6"  @if(!old('time-end6')) value="{{date('H:i', strtotime("+1 hours"))}}" @else value ="{{old('time-end6')}}" @endif  class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-end6') }}</div>

    <p>Repeat on these days</p>

    <div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
        @foreach ($days as $day => $dayValue)
            <label class="btn btn-outline-quest col-auto px-4">
                <input type="checkbox" name="day6[]"
                       value=" {{$day}}" @if(old('day6')) @if(in_array($day, old('day6'))) checked @endif @endif>
                {{ $dayValue}}
            </label>
        @endforeach
    </div>
    <div class="text-danger pb-3">{{ $errors->first('day6') }}</div>
</div>


<!---------------------sedmi--------------------------->
<div id="time7" class="pb-5 border-bottom p-2" style="display: none">
    <p class="title">Event time: -7</p>
    <div class="form-group">
        <label for='time-start7'>Start time:</label>
        <input type="time" name="time-start7"  @if(!old('time-start7')) value="{{date('H:i')}}" @else value ="{{old('time-start7')}}" @endif class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-start7') }}</div>

    <div class="form-group">
        <label for='time-end7'>End time:</label>
        <input type="time" name="time-end7"  @if(!old('time-end7')) value="{{date('H:i', strtotime("+1 hours"))}}" @else value ="{{old('time-end7')}}" @endif  class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-end7') }}</div>

    <p>Repeat on these days</p>

    <div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
        @foreach ($days as $day => $dayValue)
            <label class="btn btn-outline-quest col-auto px-4">
                <input type="checkbox" name="day7[]"
                       value=" {{$day}}" @if(old('day7')) @if(in_array($day, old('day7'))) checked @endif @endif>
                {{ $dayValue}}
            </label>
        @endforeach
    </div>
    <div class="text-danger pb-3">{{ $errors->first('day7') }}</div>
</div>


<!---------------------osmi--------------------------->
<div id="time8" class="pb-5 border-bottom p-2" style="display: none">
    <p class="title">Event time: -8</p>
    <div class="form-group">
        <label for='time-start8'>Start time:</label>
        <input type="time" name="time-start8"  @if(!old('time-start8')) value="{{date('H:i')}}" @else value ="{{old('time-start8')}}" @endif class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-start8') }}</div>

    <div class="form-group">
        <label for='time-end8'>End time:</label>
        <input type="time" name="time-end8"  @if(!old('time-end8')) value="{{date('H:i', strtotime("+1 hours"))}}" @else value ="{{old('time-end8')}}" @endif  class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-end8') }}</div>

    <p>Repeat on these days</p>

    <div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
        @foreach ($days as $day => $dayValue)
            <label class="btn btn-outline-quest col-auto px-4">
                <input type="checkbox" name="day8[]"
                       value=" {{$day}}" @if(old('day8')) @if(in_array($day, old('day8'))) checked @endif @endif>
                {{ $dayValue}}
            </label>
        @endforeach
    </div>
    <div class="text-danger pb-3">{{ $errors->first('day8') }}</div>
</div>



<!---------------------deveti--------------------------->
<div id="time9" class="pb-5 border-bottom p-2" style="display: none">
    <p class="title">Event time: -9</p>
    <div class="form-group">
        <label for='time-start9'>Start time:</label>
        <input type="time" name="time-start9"  @if(!old('time-start9')) value="{{date('H:i')}}" @else value ="{{old('time-start9')}}" @endif class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-start9') }}</div>

    <div class="form-group">
        <label for='time-end9'>End time:</label>
        <input type="time" name="time-end9"  @if(!old('time-end9')) value="{{date('H:i', strtotime("+1 hours"))}}" @else value ="{{old('time-end9')}}" @endif  class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-end9') }}</div>

    <p>Repeat on these days</p>

    <div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
        @foreach ($days as $day => $dayValue)
            <label class="btn btn-outline-quest col-auto px-4">
                <input type="checkbox" name="day9[]"
                       value=" {{$day}}" @if(old('day9')) @if(in_array($day, old('day9'))) checked @endif @endif>
                {{ $dayValue}}
            </label>
        @endforeach
    </div>
    <div class="text-danger pb-3">{{ $errors->first('day9') }}</div>
</div>

<!---------------------deseti--------------------------->
<div id="time10" class="pb-5 border-bottom p-2" style="display: none">
    <p class="title">Event time: -10</p>
    <div class="form-group">
        <label for='time-start10'>Start time:</label>
        <input type="time" name="time-start10"  @if(!old('time-start10')) value="{{date('H:i')}}" @else value ="{{old('time-start10')}}" @endif class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-start10') }}</div>

    <div class="form-group">
        <label for='time-end10'>End time:</label>
        <input type="time" name="time-end10"  @if(!old('time-end10')) value="{{date('H:i', strtotime("+1 hours"))}}" @else value ="{{old('time-end10')}}" @endif  class="form-control">
    </div>
    <div class="text-danger pb-3">{{ $errors->first('time-end10') }}</div>

    <p>Repeat on these days</p>

    <div class="btn-group-toggle mb-2 row justify-content-around" data-toggle="buttons">
        @foreach ($days as $day => $dayValue)
            <label class="btn btn-outline-quest col-auto px-4">
                <input type="checkbox" name="day10[]"
                       value=" {{$day}}" @if(old('day10')) @if(in_array($day, old('day10'))) checked @endif @endif>
                {{ $dayValue}}
            </label>
        @endforeach
    </div>
    <div class="text-danger pb-3">{{ $errors->first('day10') }}</div>
</div>







