<div class="container mt-2">
    @if($admin[0]->id == $user->id)
        <div class="row" style="margin-top: 15px; margin-bottom: 15px">
            <p class="px-2">
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
                            <input type="hidden" name="groupId" value="{{ $group->id }}">
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
    @endif

    <div class="container">
        <!-- contacts card -->
        <div class="card card-default" id="card_contacts">
            <div id="contacts" class="panel-collapse collapse show" aria-expanded="true" style="">
                <ul class="list-group pull-down" id="contact-list">
                    @foreach($members as $user_row)
                        <li class="list-group-item">
                            <div class="row w-100">
                                <div class="col-12 col-sm-6 col-md-3 px-0">
                                    <img src="{{ asset('storage/' .$user_row->profile_pic) }}" class="rounded-circle mx-auto d-block img-fluid" width="128" height="128">
                                </div>
                                <div class="col-12 col-sm-6 col-md-9 text-center text-sm-left">
                                    @if($admin[0]->id == $user->id and $admin[0]->id != $user_row->id)
                                        <span class="float-right pulse">

                                                <form action="/users/removePersonFromGroup" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="user" value="{{ $user_row->id }}">
                                                <input type="hidden" name="groupId" value="{{ $group->id }}">
                                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-user-minus"></i></button>
                                            </form>
                                        </span>
                                    @endif
                                    <label class="name lead"><a href="/user/{{ $user_row->id }}">{{ $user_row->name }}</a></label>
                                    <br>
                                    <span class="fa fa-map-marker fa-fw text-muted" data-toggle="tooltip"></span>
                                    <span class="text-muted">{{ $user_row->street_name ?? 'N/A' }}</span>
                                    <br>
                                    <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip"></span>
                                    <span class="text-muted small">{{ $user_row->phone_number ?? 'N/A' }}</span>
                                    <br>
                                    <span class="fas fa-calendar-alt text-muted" data-toggle="tooltip"></span>
                                    <span class="text-muted small text-truncate">Part Of Exter Since: {{ $user_row->created_at->format('d.m.Y') }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!--/contacts list-->
            </div>
        </div>
    </div>
</div>
