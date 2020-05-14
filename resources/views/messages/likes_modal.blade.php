<!-- Trigger the modal with a button -->
@if(Str::upper($title) == 'LIKE')
    <button type="button" class="btn modal-btn likes" id="likebutton{{ $message->id }}" click="{{ $message->id }}" data-toggle="modal" data-target="#myModal">
       LIKES<a class="likescroll-likes"> {{ $message->likes }}</a>
    </button>
@elseif(Str::upper($title) == 'DISLIKE')
    <button type="button" class="btn modal-btn dislikes" id="dislikebutton{{ $message->id }}" click="{{ $message->id }}" data-toggle="modal" data-target="#myModal">
        DISLIKES <a class="likescroll-dislikes"> {{ $message->dislikes }}</a>
    </button>
@endif


<!-- Modal LIKES -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <!-- <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div> -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
