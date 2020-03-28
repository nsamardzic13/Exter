@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <h2 class="text-center">Bootstrap 4</h2>
        @foreach($messages as $message)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="/user/{{ $message->user_id }}"><img src="{{ asset('storage/' . $message->user->profile_pic) }}" class="img-fluid rounded-circle mb-2" width="128" height="128"/></a>
                            <p class="text-secondary text-center">{{ $message->created_at }}</p>
                        </div>
                        <div class="col-md-10">
                            <p>
                                <a class="float-left" href="/user/{{ $message->user_id }}"><strong>{{ $message->user->name }}</strong></a>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>

                            </p>
                            <div class="clearfix"></div>
                            <p>{{ $message->message_text }}</p>
                            <p>
                                <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
                                <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <br>
        <form action="/wall" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="group_id" value="{{ $group->id }}">
            <div class="form-group">
                <label for="comment">{{ __('Add Your Comment:') }}</label>
                <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
                <button type="submit" class="btn btn-success float-right">
                    {{ __('Submit Comment') }}
                </button>
            </div>
        </form>
    </div>
@endsection
