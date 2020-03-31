@foreach($messages as $message)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <a href="/user/{{ $message->user_id }}"><img src="{{ asset('storage/' . $message->user->profile_pic) }}" class="img-fluid rounded-circle mb-2" width="128" height="128"/></a>
                    <p class="text-secondary text-center">{{ $message->created_at }}</p>
                </div>
                <div class="col-md-10">
                    <p>
                        <a class="float-left" href="/user/{{ $message->user_id }}"><strong>{{ $message->user->name }}</strong></a>
                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>

                    </p>
                    <div class="clearfix"></div>
                    <p>{{ $message->message_text }}</p>
                    <p>
                        {{--                                @if(\Illuminate\Support\Facades\DB::table('likes')
                                                                                            ->where('user_id', '=', $user->id)
                                                                                            ->where('message_id', '=', $message->id)
                                                                                            ->where('type', '=', false)
                                                                                            ->doesntExist())
                                                            <form id='like{{ $message->id }}' action="/groups/{{ $group->id }}" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                @isset($event)
                                                                    <input type="hidden" name="group_id" value="{{ $event->id }}">
                                                                    <input type="hidden" name="type" value="event">
                                                                @endisset
                                                                @isset($group)
                                                                    <input type="hidden" name="group_id" value="{{ $group->id }}">
                                                                    <input type="hidden" name="type" value="group">
                                                                @endisset
                                                                <input type="hidden" name="message_id" value="{{ $message->id }}">
                                                                <input type="hidden" name="like_dislike" value="dislike">
                                                                <a onclick="likeMessage({{$message->id}},'dislike',{{$group->id}},'group')" class="float-right btn btn-outline-primary ml-2"> <i class="fas fa-thumbs-down"></i> Dislike</a>
                                                            </form>
                                                        @endif
                                                        @if(\Illuminate\Support\Facades\DB::table('likes')
                                                                                        ->where('user_id', '=', $user->id)
                                                                                        ->where('message_id', '=', $message->id)
                                                                                        ->where('type', '=', true)
                                                                                        ->doesntExist())
                                                            <form id='dislike{{$message->id}}' action="/groups/{{ $group->id }}" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                @isset($event)
                                                                    <input type="hidden" name="group_id" value="{{ $event->id }}">
                                                                    <input type="hidden" name="type" value="event">
                                                                @endisset
                                                                @isset($group)
                                                                    <input type="hidden" name="group_id" value="{{ $group->id }}">
                                                                    <input type="hidden" name="type" value="group">
                                                                @endisset
                                                                <input type="hidden" name="message_id" value="{{ $message->id }}">
                                                                <input type="hidden" name="like_dislike" value="like">
                                                                <a onclick="document.getElementById('dislike{{ $message->id }}').submit()" class="float-right btn text-white btn-success"> <i class="fas fa-thumbs-up"></i> Like</a>
                                                            </form>
                                                        @endif--}}


                        @if(\Illuminate\Support\Facades\DB::table('likes')
                            ->where('user_id', '=', $user->id)
                            ->where('message_id', '=', $message->id)
                            ->where('type', '=', false)
                            ->doesntExist())
                            @isset($event)
                                <input type="hidden" name="group_id" id="group_id{{ $message->id }}" value="{{ $event->id }}">
                                <input type="hidden" name="type" id="type{{ $message->id }}" value="event">
                            @endisset
                            @isset($group)
                                <input type="hidden" name="group_id" id="group_id{{ $message->id }}" value="{{ $group->id }}">
                                <input type="hidden" name="type" id="type{{ $message->id }}" value="group">
                            @endisset
                            <input type="hidden" name="message_id" id="message_id{{ $message->id }}" value="{{ $message->id }}">
                            <input type="hidden" name="like_dislike" id="like_dislike{{ $message->id }}" value="dislike">
                            <a class="a_dislike float-right btn btn-outline-primary ml-2" id="{{ $message->id }}"> <i class="fas fa-thumbs-down"></i> Dislike</a>
                        @endif
                        @if(\Illuminate\Support\Facades\DB::table('likes')
                                                        ->where('user_id', '=', $user->id)
                                                        ->where('message_id', '=', $message->id)
                                                        ->where('type', '=', true)
                                                        ->doesntExist())
                            @isset($event)
                                <input type="hidden" name="group_id" id="group_id{{ $message->id }}" value="{{ $event->id }}">
                                <input type="hidden" name="type" id="type{{ $message->id }}" value="event">
                            @endisset
                            @isset($group)
                                <input type="hidden" name="group_id" id="group_id{{ $message->id }}" value="{{ $group->id }}">
                                <input type="hidden" name="type" id="type{{ $message->id }}" value="group">
                            @endisset
                            <input type="hidden" name="message_id" id="message_id{{ $message->id }}" value="{{ $message->id }}">
                            <input type="hidden" name="like_dislike" id="group_id{{ $message->id }}" value="like">
                            <a class="a_like float-right btn text-white btn-success" id="{{ $message->id }}"> <i class="fas fa-thumbs-up"></i> Like</a>
                        @endif
                    </p>
                    <br><br>
                    <p>
                        <a class="float-right">DISLIKES {{ $message->dislikes }}</a>
                        <a class="float-right" style="margin-right: 10px">LIKES {{ $message->likes }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endforeach
