@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <h2 class="text-center">WALL OF "{{ Str::upper($group->name) }}"</h2>
        <section class="posts endless-pagination" data-next-page="{{ $messages->nextPageUrl() }}">
            @include('messages.index_scroll')
        </section>
        <br>
        <form action="/wall" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            @isset($event)
                <input type="hidden" name="group_id" value="{{ $event->id }}">
                <input type="hidden" name="type" value="event">
            @endisset
            @isset($group)
                <input type="hidden" name="group_id" value="{{ $group->id }}">
                <input type="hidden" name="type" value="group">
            @endisset
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
