@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Info about {{ $group->name }}</h1>
        <form action="/groups/{{ $group->id }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            <div class="form-group">
                <label for="exampleInputEmail1">Dodaj osobu</label>
                <input class="form-control" type="text" id="user_name" name="name" placeholder="Enter name of a person you want to add to this group" autocomplete="off">
                <div id="userList"></div>
                <div>{{ $errors->first('name') }}</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            @csrf
        </form>

        @foreach($group->users as $row)
            <div class="row">
                <div class="col-2">
                    <p> {{ $row->name }} </p>
                </div>
            </div>
        @endforeach

    </div>

@endsection
