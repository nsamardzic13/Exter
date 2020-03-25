

<!-- Trigger the modal with a button -->

@php
    use App\Http\Controllers\OccasionsController;
      $time = OccasionsController::showTimesForModal($occasion);

@endphp
<!-- Modal -->
<div id="myModal{{$occasion->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title card-element-title text-secondary"> <strong>{{ $occasion->name }}</strong></h3>
            </div>

            <div class="modal-body">
                <div class=" clearfix">
                    <div class="container-fluid">
                        <div class="p-3 border-bottom text-center text-muted">
                            <h6> <i>{{ $occasion->description }}</i></h6>
                        </div>
                        <div class="row p-2 pt-3">
                            <div class="col-6   text-center border-right text-secondary">
                                <p><strong>Category:</strong></p>
                            </div>
                            <div class="col-6  text-center text-orange">
                                <p>{{ $occasion->category }}</p>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-6  text-center border-right text-secondary">
                                <p><strong>Location: </strong></p>
                            </div>
                            <div class="col-6  text-center text-orange">
                                <p>{{ $occasion->street }}, {{ $occasion->city }}</p>
                            </div>
                        </div>
                        <div class="container-fluid border" style="background: rgba(255, 255, 255, 0.5); max-height: calc(80vh - 210px);
    overflow-y: auto;">
                            @foreach($time as $t)
                                <div class="card p-3 text-center card-details">
                                    <div class="row">
                                        <div class="col-6 px-2 ">
                                            <p class="text-secondary border-bottom p-3"><strong>Start</strong></p>
                                            <p class="p-2"> {{ date('d.m.Y', strtotime($t->start))}}</p>
                                            <p class="p-2"> {{ date('h:i A', strtotime($t->start))}}</p>
                                        </div>
                                        <div class="col-6 px-2">
                                            <p class="text-secondary border-bottom p-3"><strong>End</strong></p>
                                            <p class="p-2"> {{ date('d.m.Y', strtotime($t->end))}}</p>
                                            <p class="p-2"> {{ date('h:i A', strtotime($t->end))}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row p-2">
                                        <div class="col-6  text-center border-right text-secondary">
                                            <p><strong>People joined:</strong></p>
                                        </div>
                                        <div class="col-6  text-center text-orange">
                                            <p>joined {{$people=OccasionsController::showPeopleForModal($t) }} out of {{ $occasion->max_people }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button <?php if($people < $occasion->max_people){
                                                echo "onclick=\"window.location.href='/events/".$t->id."/wall'\" class=\"btn-outline-success container-fluid btn\"";
                                            } else {
                                                echo "class=\"btn-outline-secondary container-fluid btn\" title=\"You can't join this event.\nThis event is full\"";
                                            }?>>JOIN</button>
                                        </div>
                                        <div class="col-6">
                                            <button <?php if($people < $occasion->max_people){
                                                echo "onclick=\"window.location.href='#'\" class=\"btn-outline-success container-fluid btn\"";
                                            } else {
                                                echo "class=\"btn-outline-secondary container-fluid btn\" title=\"You can't join this event.\nThis event is full\"";
                                            }?>>JOIN GROUP</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

