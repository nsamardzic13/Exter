@extends('layouts.app')

@section('content')
{{--    @dd(Request::fullUrl())--}}
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="tab" href="#members" role="tab" aria-controls="members" aria-selected="false">Profile</a>
        <a class="nav-link" id="v-pills-messages-tab" data-toggle="tab" href="#wall" role="tab" aria-controls="wall" aria-selected="false">Messages</a>
        <a class="nav-link" id="v-pills-settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
    </div>
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"></div>
        <div class="tab-pane fade" id="members" role="tabpanel" aria-labelledby="members-tab">@include('messages.new_user')</div>
        <div class="tab-pane fade" id="wall" role="tabpanel" aria-labelledby="wall-tab">@include('messages.index')</div>
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">@include('groups.edit')</div>
    </div>
@endsection
