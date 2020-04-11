<!-- Trigger the modal with a button -->
@if(Str::upper($title) == 'LIKE')
    <button type="button" class="btn float-right" data-toggle="modal" data-target="#myModal_likes{{ $message->id }}" style="height:100px; width:50px">
        <span class="float-right">LIKES<a class="likescroll-likes" style="margin-right: 10px"> {{ $message->likes }}</a></span>
    </button>
@elseif(Str::upper($title) == 'DISLIKE')
    <button type="button" class="btn float-right" data-toggle="modal" data-target="#myModal_dislikes{{ $message->id }}" style="height:100px; width:50px">
        <span class="float-right">DISLIKES <a class="likescroll-dislikes"> {{ $message->dislikes }}</a></span>
    </button>
@endif


<!-- Modal LIKES -->
<div id="myModal_likes{{ $message->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Message liked by:</h4>
            </div>
            <div class="modal-body">
                @foreach(\Illuminate\Support\Facades\DB::table('likes')
                    ->select('message_id', 'users.id as user_id', 'users.name', 'type')
                    ->join('users', 'likes.user_id','=', 'users.id')
                    ->where('message_id', '=', $message->id)
                    ->where('type', '=', true)
                    ->paginate(5) as $like)
                    <p>
                        <a href="/user/{{$like->user_id}}"> {{ $like->name }} </a>
                    </p>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal DISLIKES -->
<div id="myModal_dislikes{{ $message->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Message disliked by:</h4>
            </div>
            <div class="modal-body">
                @foreach(\Illuminate\Support\Facades\DB::table('likes')
                    ->select('message_id', 'users.id as user_id', 'users.name', 'type')
                    ->join('users', 'likes.user_id','=', 'users.id')
                    ->where('message_id', '=', $message->id)
                    ->where('type', '=', false)
                    ->paginate(5) as $like)
                    <p>
                        <a href="/user/{{$like->user_id}}"> {{ $like->name }} </a>
                    </p>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
