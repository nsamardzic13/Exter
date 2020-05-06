@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row my-3 pt-lg-5">
            @if(!count($user->groups))
                <div class="">
                    <h4>You dont have any groups</h4>
                </div>
            @else
                <div class="">
                    <h4>Pick a group</h4>
                </div>

        </div>
        <div class="row my-3">
            <div class="col-7">
                <form action="/events/{{$occasion->id}}" method="get" >
                    <ul class="nav nav-pills mb-3 tabs nav-fill" id="pills-tab" role="tablist">
                        @foreach($user->groups as $group)
                            <li class="nav-item">
                                <a class="nav-link " id="{{$group->name}}-tab" name="changegroup" data-toggle="tab" href="#{{$group->name}}" role="tab" aria-controls="{{$group->name}}" aria-selected="true">{{$group->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <hr>
                    <p class="text-secondary text-md-center">You can join <span id="num_people">{{$people}} </span>people</p>
                    <div class="tab-content" id="pills-tabContent">
                        @foreach($user->groups as $group)
                            <div class="tab-pane fade show " id="{{$group->name}}" role="tabpanel" aria-labelledby="{{$group->name}}-tab">
                                <h4> Users:</h4>
                                <div class="btn-group-toggle mb-2 row justify-content-lg-center" data-toggle="buttons">
                                    @foreach($group->users()->orderBy('name')->get() as $groupuser)
                                        @if(!in_array($groupuser->id, $joined))
                                            <label name="{{$group->name}}-tabusers" class="btn btn-outline-quest col-auto px-4 tabusers">
                                                <input type="checkbox" class="groupusers " name="{{$group->name}}-tabusers[]" value="{{$groupuser->id}}">{{$groupuser->name}}</input>
                                            </label>
                                        @else
                                            <label class="btn btn-outline-secondary col-auto px-4">
                                                <input type="checkbox" class="disabled" disabled="disabled" name="{{$group->name}}-tabusers-disabled">{{$groupuser->name}} (Already joined)</input>
                                            </label>
                                        @endif
                                            &nbsp;&nbsp;
                                    @endforeach
                                </div>
                            </div>

                        @endforeach
                        <div id="options-select-users" style="display: none">
                            <div class="bottom p-5 row border-bottom border-top">
                                <div class="col-6 px-4 text-md-center">
                                    <label class="btn btn-primary px-4 container-fluid" id="checkallusers">Check all</label>
                                </div>
                                <div class="col-6 px-4  text-md-center">
                                    <label class="btn btn-primary px-4 container-fluid" id="uncheckallusers">Unheck all</label>
                                </div>
                                <span class="row text-danger align-content-center" id="cannot_checkall" >Cannot check all, you can join {{$people}} people, please specify which people you want to add</span>
                            </div>
                            <div class="row container-fluid p-3 border-bottom">
                                <p class="col text-md-center text-secondary">Selected <span id="selected_people">0</span> out of {{$people}}</p>
                            </div>


                             <div class="container-fluid p-5 row">
                                 <button type="submit" class="btn btn-outline-quest2 btn-lg my-2 ml-4 px-5 container-fluid bg-light">Join to event {{$occasion->name}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-5 px-5">
                <img class="img-fluid" src="{{ asset('images/group.png') }}" >
            </div>
            @endif
        </div>
    </div>


@endsection

