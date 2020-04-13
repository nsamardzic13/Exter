<!-- Trigger the modal with a button -->
@if(Str::upper($title) == 'LIKE')
    <button type="button" class="btn float-right modal-btn likes" id="{{ $message->id }}" click="{{ $message->id }}" data-toggle="modal" data-target="#myModal" style="height:100px; width:50px">
        <span class="float-right">LIKES<a class="likescroll-likes" style="margin-right: 10px"> {{ $message->likes }}</a></span>
    </button>
@elseif(Str::upper($title) == 'DISLIKE')
    <button type="button" class="btn float-right modal-btn dislikes" id="{{ $message->id }}" click="{{ $message->id }}" data-toggle="modal" data-target="#myModal" style="height:100px; width:50px">
        <span class="float-right">DISLIKES <a class="likescroll-dislikes"> {{ $message->dislikes }}</a></span>
    </button>
@endif


<!-- Modal LIKES -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
