<div class="row" style="margin-top: 15px; margin-bottom: 15px">
        <p>
            <button type="button" class="btn  btn-success float-left" data-toggle="modal" data-target="#myModal_newuser">
                Add New User
            </button>
        </p>
</div>

<!-- Modal LIKES -->
<div id="myModal_newuser" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="/users/addPersonToGroup" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dodaj osobu</label>
                        <input class="form-control" type="text" id="user_name" name="name" placeholder="Enter name of a person you want to add to this group" autocomplete="off">
                        <div id="userList"></div>
                        <div>{{ $errors->first('name') }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@foreach($group->users()->orderBy('name')->paginate(1) as $row)
    <div class="row" style="margin-bottom: 5px">
        <div class="col-lg-4">
            <img src="{{ asset('storage/' .$user->profile_pic) }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
            <a style="margin-left: 10px" href="/user/{{ $row->id }}">{{ $row->name }}</a>
        </div>
    </div>
@endforeach
<div class="row" style="margin-bottom: 5px">
    <div class="col-lg-4">
        {!! $group->users()->orderBy('name')->paginate(1)->links() !!}
    </div>
</div>
