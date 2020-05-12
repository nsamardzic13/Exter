<!-- Modal LIKES -->
<div id="myModal_newmessage" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">New post: </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="/wall" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    @isset($occasion)
                        <input type="hidden" name="group_id" value="{{ $occasion->id }}">
                        <input type="hidden" name="type" value="event">
                    @endisset
                    @isset($group)
                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                        <input type="hidden" name="type" value="group">
                    @endisset
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success float-left">
                        <b>{{ __('Submit') }} </b>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
