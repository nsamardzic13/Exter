@forelse($messages as $message)
    <div class="card mb-3 smaller-zoom">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 text-center">
                    <a href="/user/{{ $message->user_id }}"><img src="{{ asset('storage/' . $message->user->profile_pic) }}" class="img-fluid rounded-circle mb-2" style="max-width: 85px"/></a>
                    <p class="text-secondary text-center">{{ date('d.m.Y', strtotime($message->created_at)) }}</p>
                </div>
                <div class="col-md-8" style="min-height: 80px; max-height: 100px">
                    <p>
                        <a class="float-left" href="/user/{{ $message->user_id }}"><strong>{{ $message->user->name }}</strong></a>
                        &nbsp;&nbsp;<small><b>At</b> {{ date('H:i', strtotime($message->created_at)) }}</small>
                    </p>
                    <div class="clearfix"></div>
                    <p style="font-size: 16px">{{ $message->message_text }}</p>

                </div>
                <div class="col-md-2" id="likes_messages{{ $message->id }}">
                    <p class="likescroll-p">
                        @isset($group)
                            <input type="hidden" name="group_id" id="group_id{{ $message->id }}" value="{{ $group->id }}">
                            <input type="hidden" name="type" id="type{{ $message->id }}" value="groups">
                        @endisset
                        @isset($occasion)
                            <input type="hidden" name="group_id" id="group_id{{ $message->id }}" value="{{ $occasion->id }}">
                            <input type="hidden" name="type" id="type{{ $message->id }}" value="events">
                        @endisset
                        <input type="hidden" name="message_id" id="message_id{{ $message->id }}" value="{{ $message->id }}">
                        <input type="hidden" name="like_dislike" id="like_dislike{{ $message->id }}" value="dislike">
                    </p>

                    <a class="likescroll-btn a_like
                            @if(\Illuminate\Support\Facades\DB::table('likes')
                                                                ->where('message_id', '=', $message->id)
                                                                ->where('user_id', '=', $user->id)
                                                                ->where('type', '=', true)
                                                                ->exists())
                            likescroll
                            @endif
                        " id="{{ $message->id }}"><i style="font-size: 25px" class="fas fa-thumbs-up thumbs_up"></i></a>

                    <a class="likescroll-btn a_dislike
                            @if(\Illuminate\Support\Facades\DB::table('likes')
                                                                ->where('message_id', '=', $message->id)
                                                                ->where('user_id', '=', $user->id)
                                                                ->where('type', '=', false)
                                                                ->exists())
                            dislikescroll
                            @endif
                        " id="{{ $message->id }}"><i style="font-size: 25px" class="fas fa-thumbs-down thumbs_down"></i></a>

                </div>
            </div>
            <hr style="margin: 2px 0 3px 0">
            <div class="row float-right">
                @include('messages.likes_modal', ['title' => 'like'])
                @include('messages.likes_modal', ['title' => 'dislike'])
            </div>
        </div>
    </div>
@empty
    <p class="text-center" style="font-size: 20px">There are no posts yet :(</p>
@endforelse

