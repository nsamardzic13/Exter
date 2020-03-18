

<!-- Trigger the modal with a button -->

@php
    use App\Http\Controllers\OccasionsController;
      $time = OccasionsController::showDataForModal($occasion);
@endphp
<!-- Modal -->
<div id="myModal{{$occasion->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header card-header-title">
                <h4 class="modal-title card-element-title"> {{ $occasion->name }}</h4>
            </div>
            <div class="modal-body">
                <div class=" clearfix">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <p><strong>Street:</strong> {{ $occasion->street }}</p>
                                <p><strong>City:</strong> {{ $occasion->city }}</p>
                                <div class="border">
                                    @foreach($time as $t)
                                        <div class="border card zoom p-2">
                                            <p> {{ $t->start}}</p>
                                            <p> {{ $t->end}}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <p><strong>Category:</strong> {{ $occasion->category }}</p>

                            </div>
                        </div>

                        <p><a href="/events">Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

