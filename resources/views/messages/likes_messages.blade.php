<p>
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
