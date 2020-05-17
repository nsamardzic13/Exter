@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="tab" href="#members" role="tab" aria-controls="members" aria-selected="false">Members</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="tab" href="#wall" role="tab" aria-controls="wall" aria-selected="false">Wall</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                </div>
            </div>

            <div class="col-lg-10">
                @if(session()->has('message'))
                    <div class="alert alert-success" role="alert" style="border-width: 1px; border-color: #27864f">
                        <strong>Success</strong> {{ session()->get('message') }}
                    </div>
                @endif
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">@include('occasions.home')</div>
                    <div class="tab-pane fade" id="members" role="tabpanel" aria-labelledby="members-tab">@include('occasions.new_user')</div>
                    <div class="tab-pane fade" id="wall" role="tabpanel" aria-labelledby="wall-tab">@include('messages.index')</div>
                    @if($occasion->user_name == $user->name)
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">@include('occasions.edit')</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('messages.new_message')
@endsection

