<div class="container" style="margin-bottom: 60px">
    <img src="{{ asset('storage/' .$admin[0]->profile_pic) }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
    <h4 class="card-title mb-0">{{ $occasion->name }}</h4>
    <div class="text-muted mb-2">{{ $occasion->category }}</div>
    <div class="text-muted mb-2">{{ $occasion->description }}</div>


    <hr class="my-0">
    <h5 class="h6 card-title"><b>About</b></h5>
    <ul class="list-unstyled mb-0">
        <li class="mb-1">
            <i class="fas fa-crown"></i>  Admin: <a href="/user/{{ $admin[0]->id }}">{{ $admin[0]->name }}</a>
            @if(Auth::user()->id != $admin[0]->id)
                @if(Auth::user()->isFollowing($admin[0]))
                    <button id="unFollow" class="btn btn-outline-quest2 btn-sm" value="{{ $admin[0]->id }}" style="margin-left: 7px"><i class="fas fa-times-circle"></i> Unfollow</button>
                @else
                    <button id="follow" class="btn btn-outline-quest btn-sm" value="{{ $admin[0]->id }}" style="margin-left: 7px"><i class="fas fa-arrow-alt-circle-left"></i> Follow</button>
                @endif
            @endif
            <input type="hidden" value="{{csrf_token()}}" name="_token">
        </li>
        <li class="mb-1">
            <i class="fas fa-globe-europe"></i>  Location:
            {{ $occasion->zipcode }} , {{ $occasion->city }} , {{ $occasion->street }}
        </li>
        <li class="mb-1">
            <i class="fas fa-calendar-week"></i>  Starting At:
            {{ $occasion->start }}
        </li>
        <li class="mb-1">
            <i class="fas fa-calendar-week"></i>  Ending At:
            {{ $occasion->end }}
        </li>
    </ul>
</div>

<div class="container">
    Who Has The Most Posts?
    @foreach($top_users as $top_user)
        <p><a href="/user/{{ $top_user->user_id }}">{{ $top_user->name }}</a> {{ $top_user->count }}</p>
    @endforeach
</div>

<div class="container">
    Who Attended The Most Events?
    @foreach($user_events as $user_event)
        <p><a href="/user/{{ $user_event->user_id }}">{{ $user_event->name }}</a> {{ $user_event->count }}</p>
    @endforeach
</div>
