@extends('layouts.app')

@section('content')

        <!-- Sidebar -->
        <div class="sidebar-wrapper">
            <!-- Sidebar -->
            <nav id="sidebar" class="border-right border-bottom border-danger">
                <div class="sidebar-header">
                    <h3><span style="color: whitesmoke"><b>Filter Events :</b></span></h3>
                </div>

                <ul class="list-unstyled components">
                    <form action="/events" method="GET">
                    <li>
                        <a href="#sports" data-toggle="collapse" aria-expanded="false"><i class="fas fa-running" style="margin-left: 5px; margin-right: 8px;"></i> Sports</a>
                        <div class="collapse" id="sports">
                            @foreach($sportcolumns as $sportKey => $sportValue)
                                <div class="custom-control custom-checkbox" style="margin: 10px 0px 10px 20px">
                                    <input type="checkbox" name="sports[]" class="custom-control-input" id="sportCheck{{ $sportKey }}"
                                           value="{{ $sportValue }}" {{ $user->sport[$sportValue] ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="sportCheck{{ $sportKey }}">
                                        <span class="checkboxText" style="margin-left: 12px">{{ ucfirst($sportValue) }}</span></label>
                                </div>
                            @endforeach
                        </div>
                    </li>
                    <li>
                        <a href="#hangouts" data-toggle="collapse" aria-expanded="false"><i class="fas fa-hand-peace" style="margin-left: 5px; margin-right: 8px; margin-left: 5px"></i> Hangouts</a>
                        <div class="collapse" id="hangouts">
                            @foreach($hangoutscolumns as $hangoutKey => $hangoutValue)
                                <div class="custom-control custom-checkbox" style="margin: 10px 0px 10px 20px">
                                    <input type="checkbox" name="hangouts[]" class="custom-control-input" id="hangoutCheck{{ $hangoutKey }}"
                                           value="{{ $hangoutValue }}" {{ $user->hangout[$hangoutValue] ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="hangoutCheck{{ $hangoutKey }}">
                                        <span class="checkboxText" style="margin-left: 12px">{{ ucfirst($hangoutValue) }}</span></label>
                                </div>
                            @endforeach
                        </div>
                    </li>
                    <li>
                        <a href="#time" data-toggle="collapse" aria-expanded="false"><i class="fas fa-clock" style=" margin-left: 5px; margin-right: 8px;"></i>Time</a>
                        <div class="collapse" id="time">
                            @foreach($availabilitycolumns as $availabilityKey => $availabilityValue)
                                <div class="custom-control custom-checkbox" style="margin: 10px 0px 10px 20px">
                                    <input type="checkbox" name="availabilities[]" class="custom-control-input" id="availabilityCheck{{ $availabilityKey }}"
                                           value="{{ $availabilityValue }}" {{ $user->availability[$availabilityValue] ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="availabilityCheck{{ $availabilityKey }}">
                                        <span class="checkboxText" style="margin-left: 12px">{{ ucfirst($availabilityValue) }}</span></label>
                                </div>
                            @endforeach
                        </div>
                    </li>
                    <li>
                        <a href="#distance" data-toggle="collapse" aria-expanded="false"><i class="fas fa-search-location" style=" margin-left: 5px; margin-right: 8px;"></i>Distance</a>
                        <div class="collapse" id="distance">
                            <div class="col-12 mt-3">
                                <input type="range" class="custom-range" min="0" max="150" step="1" id="rangeIndicator" value="{{ $range }}">
                                <input type="hidden" id="inputRangeValue" name="range" value="{{ $range }}">
                                <span>Range Value: <span id="rangeValue"></span>km
                            </div>
                        </div>
                    </li>

                    <div style="text-align: center">
                        <div>
                            <button type="submit" class="btn btn-outline-quest rounded-pill my-3 zoom" name="cancelFilters" value="false"><b>Submit</b></button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-outline-quest2 rounded-pill mt-1 zoom" name="cancelFilters" value="true"><b><i class="fas fa-times"></i> Cancel filters</b></button>
                        </div>
                    </div>
                    @csrf
                    </form>
                </ul>

            </nav>
            <!-- Page Content -->
            <div id="content" class="container-fluid pt-2" style="background-color: #f1e5e6;">
                <h1 class="p-lg-3 pl-5 border-bottom"><span class="events-title">Upcoming events</span>
                    <button type="button" id="sidebarCollapse" class="btn btn-outline-quest2">
                        <i class="fas fa-filter"></i>
                    </button>
                    <span class="float-right">
                        <a href="/events/create" class="btn btn-outline-quest2 rounded-pill zoom"><i class="fas fa-edit"></i> Make new event!</a>
                    </span>
                </h1>

                    @if(session()->has('message'))
                        <div class="alert alert-success" role="alert" style="border-width: 1px; border-color: #27864f">
                            <strong>Success</strong> {{ session()->get('message') }}
                        </div>
                    @endif
                @if(!$occasions->isEmpty())
                    <div class="row pl-4">
                    @foreach($occasions as $eventNmb => $event)
                                    <div class="col-lg-4 col-sm-8 col-md-8 my-4" data-aos="fade-up">
                                        <div class="card zoom " style="border-color: #FF8663; border-width: 2px; color: #2d995b;">
                                            <img class="card-img-top img-fluid" style="height: 225px; width: 100%; display: block;" @if($event->picture) src="{{ asset('storage/' .$event->picture) }}"
                                                 @else src="{{ url('images/hangout-sports/'.$event->category.'.png') }}"  @endif  alt="Card image cap">
                                            <div class="card-body">
                                                <h4 class="card-title p-2">{{ $event->name }}</h4>
                                                <h6 class="card-subtitle mb-2 text-muted row"><i class="fas fa-calendar-day col-sm-1"></i><p class="col-sm">{{ date('d.m.Y', strtotime($event->start))}}</p>
                                                    <i class="fas fa-clock pl-3 col-sm-1"></i> <p class="col-sm">{{ date('H:i', strtotime($event->start))}}</p></h6>
                                                <h6 class="card-subtitle mb-2 text-muted row"><i class="fas fa-map-marker-alt col-sm-1"></i><p class="col-sm"> {{ $event->street }}</p>
                                                    <i class="fas fa-route pl-3 col-sm-1"></i> <p class="col-sm">@if (property_exists($event, "dist")){{ number_format($event->dist, 2, '.', '') }}km @else -- km @endif</p></h6>
                                                <h6 class="card-subtitle mb-2 text-muted row"><i class="fas fa-list-alt pr-2 col-sm-1"></i><p class="col-sm-11">{{ $event->category }}</p></h6>
                                                <h6 class="card-subtitle mb-2 text-muted row"><i class="fas fa-user-tie pr-2 col-sm-1"></i><p class="col-sm-11">{{ $event->user_name }}</p></h6>
                                                <p class="card-text">{{ $event->description }}</p>
                                                <button type="button" class="btn btn-outline-success btn-lg my-2 ml-4 center-block" data-toggle="modal" data-target="#myModal{{$event->id}}">Open</button>

                                            </div>
                                        </div>
                                    </div>
                                    @include('occasions.show',  ['occasion' => $event])
                                @endforeach
                            </div>
                    @else
                        <div class="card mt-5 rounded-pill">
                            <div class="card-body text-center">
                                <h4 class="mx-auto text-orange font-weight-bolder">There are no upcoming events </h4>
                                <a href="/events/create" class="btn btn-outline-quest2 rounded-pill">Create one <i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    @endif
            </div>
        </div>


@endsection
