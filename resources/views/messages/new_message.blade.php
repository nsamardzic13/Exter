<p>
    <button type="button" class="btn  btn-success float-left" data-toggle="modal" data-target="#myModal_newmessage">
        POST SOMETHING!
    </button>
</p>


    <!-- Modal LIKES -->
<div id="myModal_newmessage" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Comment:</h4>
            </div>
            <div class="modal-body">
                <form action="/wall" method="POST">
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
                        <label for="comment">{{ __('Add Your Comment:') }}</label>
                        <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
                        <button type="submit" class="btn btn-success float-right">
                            {{ __('Submit Comment') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
