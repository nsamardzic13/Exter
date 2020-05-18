<div class="container mt-2" style="margin-bottom: 60px">
    <div class="text-center">
        <img @if($occasion->picture) src="{{ asset('storage/' .$occasion->picture) }}"
             @else src="{{ url('images/hangout-sports/'.$occasion->category.'.png') }}"  @endif  class="img-fluid rounded-circle mb-2" width="128" height="128">
        <h4 class="card-title mb-0">{{ $occasion->name }}</h4>
        <div class="text-muted mb-2">{{ $occasion->category }}</div>
        <div class="row">
            <div class="text-muted mb-2 col-3"></div>
            <div class="text-muted mb-2 col-3 border-right">{{ $occasion->start->format(' d.m.Y') }}</div>
            <div class="text-muted mb-2 col-3">{{ $occasion->start->format(' H:i') }}</div>
            <div class="text-muted mb-2 col-3"></div>

        </div>
        <div class="text-muted mb-2">{{ $occasion->street }}</div>
        <div class="text-muted mb-2">{{ $occasion->description }}</div>
    </div>


    <hr class="my-0">

    <div class="text-center mt-2 mb-4">
        <h4><b>About</b></h4>
        <ul class="list-unstyled mb-0">
            <li class="mb-1">
                {{--            @dd($admin)--}}
                <span class="addon"><i class="fas fa-crown"></i></span>  Admin: <a href="/user/{{ $admin[0]->id }}"><b>{{ $admin[0]->name }}</b></a>
                @if(Auth::user()->id != $admin[0]->id)
                    @if(Auth::user()->isFollowing($admin[0]))
                        <button id="unFollow" class="btn btn-outline-quest2 btn-sm" value="{{ $admin[0]->id }}" style="margin-left: 7px"><i class="fas fa-times-circle"></i> Unfollow</button>
                    @else
                        <button id="follow" class="btn btn-outline-quest btn-sm" value="{{ $admin[0]->id }}" style="margin-left: 7px"><i class="fas fa-arrow-alt-circle-left"></i> Follow</button>
                    @endif
                @endif
                <input type="hidden" value="{{csrf_token()}}" name="_token">
            </li>
            <li>
                <span class="addon"><i class="fas fa-calendar-week"></i></span>  Part of Exter since:
                {{ $occasion->created_at->format('d.m.Y') }}
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-6 col-sm-10">
            <div class="card zoom mb-4">
                <div class="card-body">
                    <h5 class="card-title">Who has the most posts?</h5>
                    <div class="row">
                        @forelse($top_users as $top_user)
                            <div class="col-6">
                                <p class="card-text" style="font-size: 20px;"><a href="/user/{{ $top_user->user_id }}">{{ $top_user->name }}</a>
                            </div>
                            <div class="col-6">
                                <p class="card-text icon-stack-sm-sm mb-2" style="margin-left: 60px; font-size: 22px">{{ $top_user->count }}</p>
                            </div>
                        @empty
                            <div class="col-12">
                                There are no posts yet  :(
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-10">
            <div class="card zoom mb-4">
                <div class="card-body">
                    <h5 class="card-title">Who attended the most events?</h5>
                    <div class="row">
                        @forelse($user_events as $user_event)
                            <div class="col-6">
                                <p class="card-text" style="font-size: 20px;"><a href="/user/{{ $user_event->user_id }}">{{ $user_event->name }}</a></p>
                            </div>
                            <div class="col-6">
                                <p class="card-text icon-stack-sm-sm mb-2" style="margin-left: 60px; font-size: 22px">{{ $user_event->count }}</p>
                            </div>
                        @empty
                            <div class="col-12">No information about peoples events :(</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card text-white bg mb-3 group-card" style="background-image: linear-gradient(135deg, #e32743 0%, rgba(255, 121, 63, 0.8) 100%);">
                <div class="card-body text-center" data-toggle="modal" data-target="#myModal_newmessage">
                    <h5 class="card-title">Post something on wall</h5>
                    <p class="card-text"><i class="fas fa-comment-dots fa-3x"></i></p>
                </div>
            </div>
        </div>

    </div>

</div>

