<div class="container mt-2">
    <div class="card">
        <div class="card-header"><h4 style="margin-top: 5px">"{{ $occasion->name }}" Settings</h4></div>

        <div class="card-body">
            <form action="/events/{{ $occasion->id }}/edit" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Group Name') }}
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

                    <div class="col-md-6">
                        <input id="profile_pic" type="file" class="form-control inputfile" name="profile_pic" autocomplete="profile_pic">
                        <label for="profile_pic"><i class="fas fa-upload" style="margin-right: 4px"></i> Choose a file</label>
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
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <form action="/user/{{ $occasion->id }}" method="POST" style="padding-top: 5px">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Delete Event
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
