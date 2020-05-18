<div class="container mt-2">
    <div class="card">
        <div class="card-header"><h4 style="margin-top: 5px">"{{ $occasion->name }}" Settings</h4></div>

        <div class="card-body">
            <form action="/events/{{ $occasion->id }}/edit" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Event name') }}
                        <span class="addon"><i class="fas fa-user"></i></span></label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $occasion->name }}" autocomplete="name" autofocus disabled>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}
                        <span class="addon"><i class="fas fa-map-marker-alt"></i></span></label>
                    <div class="col-md-6">
                        <input type="text" name="street" id="event_address" value="{{$occasion->street}}" class="form-control" >
                        @error('street')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Start time') }}
                        <span class="addon"><i class="fas fa-clock"></i></span></label>
                    <div class="col-md-6">
                        <input type="time" name="start" value="{{date('H:i', strtotime($occasion->start))}}" class="form-control" >
                        @error('start')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="end" class="col-md-4 col-form-label text-md-right">{{ __('End time') }}
                        <span class="addon"><i class="fas fa-clock"></i></span></label>
                    <div class="col-md-6">
                        <input type="time" name="end" value="{{date('H:i', strtotime($occasion->end))}}" class="form-control" >
                        @error('end')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="max_people" class="col-md-4 col-form-label text-md-right">{{ __('Maximum number of people') }}
                        <span class="addon"><i class="fas fa-user-friends"></i></span></label>
                    <div class="col-md-6">
                        <input type="number" name="max_people" value="{{$occasion->max_people}}" class="form-control" >
                        @error('max_people')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }} </label>
                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control @error('name') is-invalid @enderror" name="description" value="{{ $occasion->description  }}" autocomplete="description" autofocus>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="profile_pic" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}
                        <span class="addon"><i class="fas fa-image"></i></span></label>

                    <div class="col-md-6 " id="length_filename">
                        <input id="picture" type="file" class="form-control inputfileevent" name="picture" autocomplete="picture">
                        <label for="picture" class="image_button"><i class="fas fa-upload" style="margin-right: 4px"></i> Choose a file
                        <span id="file-upload-filename" class="col file-upload-filename" style="display: none"></span></label>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success submit">
                            Submit changes
                        </button>
                    </div>
                </div>
            </form>
            <div class="form-group row mb-2 mt-2">
                <div class="col-md-6 offset-md-4">
                    <form action="/user/{{ $occasion->id }}" method="POST" style="padding-top: 5px">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> <b>Delete Group</b>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
