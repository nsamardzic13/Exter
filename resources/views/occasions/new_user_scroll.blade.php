@foreach($attending as $user_row)
    <li class="list-group-item">
        <div class="row w-100">
            <div class="col-12 col-sm-6 col-md-3 px-0">
                <img src="{{ asset('storage/' .$user_row->profile_pic) }}" class="rounded-circle mx-auto d-block img-fluid" width="128" height="128">
            </div>
            <div class="col-12 col-sm-6 col-md-9 text-center text-sm-left">
                @if($admin[0]->id == $user->id and $admin[0]->id != $user_row->id)
                    <span class="float-right pulse">

                                                <form action="/users/removePersonFromEvent" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="user" value="{{ $user_row->id }}">
                                                <input type="hidden" name="eventId" value="{{ $occasion->id }}">
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Remove this person"><i class="fas fa-user-minus"></i></button>
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
