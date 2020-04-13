<br>
<form action="/groups/{{ $group->id }}/edit" method="post">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Group Name') }} </label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $group->name }}" autocomplete="name" autofocus disabled>
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
            <input id="description" type="text" class="form-control @error('name') is-invalid @enderror" name="description" value="{{ $group->description  }}" autocomplete="description" autofocus>
            @error('description')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-success">
                {{ __('Submit Changes') }}
            </button>
        </div>
    </div>
</form>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        @if($group->admin_id == $user->id)
            <form action="/user/{{ $group->id }}" method="POST" style="padding-top: 5px">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Delete Group</button>
            </form>
        @endif
    </div>
</div>
