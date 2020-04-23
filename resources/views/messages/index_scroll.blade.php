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
                    <div id="likes_messages{{ $message->id }}">
                        <p class="likescroll-p">
                            @isset($event)
                                <input type="hidden" name="group_id" id="group_id{{ $message->id }}" value="{{ $event->id }}">
                                <input type="hidden" name="type" id="type{{ $message->id }}" value="event">
                            @endisset
                            @isset($occasion)
                                <input type="hidden" name="group_id" id="group_id{{ $message->id }}" value="{{ $occasion->id }}">
                                <input type="hidden" name="type" id="type{{ $message->id }}" value="group">
                            @endisset
                            <input type="hidden" name="message_id" id="message_id{{ $message->id }}" value="{{ $message->id }}">
                            <input type="hidden" name="like_dislike" id="like_dislike{{ $message->id }}" value="dislike">

                            <a style="padding:1vw" class="likescroll-btn a_like
                            @if(\Illuminate\Support\Facades\DB::table('likes')
                                                                ->where('message_id', '=', $message->id)
                                                                ->where('user_id', '=', $user->id)
                                                                ->where('type', '=', true)
                                                                ->exists())
                                likescroll
                            @endif
                            " id="{{ $message->id }}"><i style="font-size: 30px" class="fas fa-thumbs-up"></i></a>

                            <a style="padding:1vw" class="likescroll-btn a_dislike
                            @if(\Illuminate\Support\Facades\DB::table('likes')
                                                                ->where('message_id', '=', $message->id)
                                                                ->where('user_id', '=', $user->id)
                                                                ->where('type', '=', false)
                                                                ->exists())
                                dislikescroll
                            @endif
                            " id="{{ $message->id }}"><i style="font-size: 30px" class="fas fa-thumbs-down"></i></a>
                        </p>
                        <br><br>
                        <p>
                            {{--<span class="float-right">DISLIKES <a class="likescroll-dislikes">{{ $message->dislikes }}</a></span>
                            <span class="float-right">LIKES <a class="likescroll-likes" style="margin-right: 10px">{{ $message->likes }}</a></span>--}}
                            @include('messages.likes_modal', ['title' => 'dislike'])
                            @include('messages.likes_modal', ['title' => 'like'])
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
