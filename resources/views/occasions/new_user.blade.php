<div class="container mt-2 card">

    <div class="card-header header-wall">
        <h3><b>Members </b> <small>of "{{ Str::upper($occasion->name ?? $occasion->name) }}"</small></h3>
        @if($admin[0]->id == $user->id)
            <button type="button" class="btn btn-outline-quest rounded-pill zoom float-right" data-toggle="modal" data-target="#myModal_newuser">
                Add New User
            </button>

        @endif
    </div>

@if($admin[0]->id == $user->id)
    <!-- Modal LIKES -->
        <div id="myModal_newuser" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/users/addPersonToEvent" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Dodaj osobu</label>
                                <input class="form-control" type="text" id="user_name" name="name" placeholder="Enter name of a person you want to add to this group" autocomplete="off">
                                <div id="userList"></div>
                                <div>{{ $errors->first('name') }}</div>
                            </div>
                            <input type="hidden" name="eventId" value="{{ $occasion->id }}">
                            @csrf
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Person</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <div class="container card-body">
        <!-- contacts card -->
        <div class="card card-default" id="card_contacts">
            <div id="contacts" class="panel-collapse collapse show" aria-expanded="true" style="">
                <ul class="list-group pull-down posts2 endless-pagination2" id="contact-list" data-next-page="{{ $attending->nextPageUrl() }}">
                    @include('occasions.new_user_scroll')
                </ul>
                <!--/contacts list-->
            </div>
        </div>
    </div>
</div>
