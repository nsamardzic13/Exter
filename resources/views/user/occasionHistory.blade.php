@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 pb-3">
                <div class="card-header border">
                    <b><i class="fas fa-history"></i> My Event history</b>
                </div>
                @if(count($user_events))
                <ul class="list-group list-group">
                    @foreach($user_events as $event)
                        <li class="list-group-item list-inline align-items-center event-column">{{ $event->name}}
                            <p><b>Created by: </b>{{ $event->user_name }}</p>
                            <span class="float-right font-weight-bold">
                            <p>started: {{ date('d.m.Y h:i', strtotime($event->start))}}
                            <p>ended: {{ date('d.m.Y h:i', strtotime($event->end))}}
                            </span>
                        </li>
                    @endforeach
                </ul>
                @else
                    <p class="text-center"><b>There are no events that have passed :(</b></p>
                @endif
            </div>
        </div>
        {{ $user_events->links() }}
        <p class="text-center">
            <a class="btn btn-outline-quest mt-2 mb-2" href="/user/{{$user->id}}" role="button">
            Back to Profile <i class="fas fa-chevron-circle-left"></i>
            </a>
        </p>
    </div>
@endsection
