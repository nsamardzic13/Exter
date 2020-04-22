<div class="container" style="margin-bottom: 60px">
    <img src="{{ asset('storage/' .$group->profile_pic) }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
    <h4 class="card-title mb-0">{{ $group->name }}</h4>
    <div class="text-muted mb-2">{{ $group->description }}</div>


    <hr class="my-0">
    <h5 class="h6 card-title"><b>About</b></h5>
    <ul class="list-unstyled mb-0">
        <li class="mb-1">
{{--            @dd($admin)--}}
            <i class="fas fa-crown"></i>  Admin: <a href="/user/{{ $admin[0]->id }}">{{ $admin[0]->name }}</a>

        </li>
        <li class="mb-1">
            <i class="fas fa-calendar-week"></i>  Part of Exter since:
                {{ $group->created_at }}
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
