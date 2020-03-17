@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/groups" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Naziv grupe</label>
            <input type="text" name="name" class="form-control" placeholder="Enter group name">
            <div>{{ $errors->first('name') }}</div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        @csrf
    </form>


    @foreach($groups as $group)
        <div class="row">
            <div class="col-2">
                <a href="/groups/{{ $group->id }}">
                    {{ $group->name }}
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
