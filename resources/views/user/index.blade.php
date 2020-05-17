@extends('layouts.app')

@section('content')
    @error('name')
        <div class="alert alert-danger" role="alert" style="border-width: 1px; border-color: #E32743">
            <strong>Failed adding group</strong> {{  $errors->first('name') }}
        </div>
    @enderror

    @error('description')
    <div class="alert alert-danger" role="alert" style="border-width: 1px; border-color: #E32743">
        <strong>Failed adding group</strong> {{  $errors->first('description') }}
    </div>
    @enderror

    @if(session()->has('message'))
        <div class="alert alert-success" role="alert" style="border-width: 1px; border-color: #27864f">
            <strong>Success</strong> {{ session()->get('message') }}
        </div>
    @endif

    <div class="container">
        <div class="row my-3">

            <!-- Left side of profile -->
            <div class="col-md-4 col-xl-4">
                <div class="card mb-3">
                    <!-- <div class="card-header">
                        <h5 class="card-title mb-0">Profile Details</h5>
                    </div> -->
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' .$user->profile_pic) }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
                        <h4 class="card-title mb-0">{{ $user->name }}</h4>
                        <div class="text-muted mb-2">{{ !$user->user_type ? 'Private user' : 'Company' }}</div>

                        <div>
                            <!-- MAYBE BUTTONS UNDER IMAGE -->
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <h5 class="h6 card-title"><b>About</b></h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">
                                <span class="addon"><i class="fas fa-home fa-1x"></i></span>  Lives in:
                                {{$user->street_name ? $user->street_name : '?'}}
                            </li>
                            <li class="mb-1">
                                <span class="addon"><i class="fas fa-envelope"></i></span>  Email:
                                {{ $user->email ? $user->email : '?'}}
                            </li>
                            <li class="mb-1">
                                <span class="addon"><i class="fas fa-phone-alt fa-1x"></i></span>  Phone number:
                                {{ $user->phone_number ? $user->phone_number : '?' }}
                            </li>
                        </ul>
                    </div>

                    <hr class="my-0">
                    <div class="card-body quest-profile">
                        <h5 class="h6 card-title"><b>Important!</b></h5>
                        <p>To make your website experience more enjoyable take few moments to check our questionary</p>
                        <div class="list-group align-items-stretch">
                            <a href="/questionary" class="list-group-item list-group-item-action text-center btn-outline-quest2"><i class="fas fa-question-circle fa-1x"></i> Questionary</a>
                        </div>
                    </div>

                    <hr class="my-0">
                    <div class="card-body align-items-center">
                        <p><b>Update/Edit your user profile</b></p>
                        <div class="list-group align-items-center">
                            <a href="/user/{{ $user->id }}/edit" class="list-group-item list-group-item-action text-center btn-outline-quest"><i class="fas fa-user-cog"></i> Settings</a>
                        </div>
                    </div>


                    <hr class="my-0">
                    <div class="card-body">
                        <h5 class="h6 card-title"><b>Other links</b></h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">
                                <svg class="svg-inline--fa fa-twitter fa-w-16 fa-fw mr-1" aria-hidden="true" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                                </svg>
                                <!-- <span class="fab fa-twitter fa-fw mr-1"></span> --><a href="#">Twitter</a></li>
                            <li class="mb-1">
                                <svg class="svg-inline--fa fa-facebook fa-w-14 fa-fw mr-1" aria-hidden="true" data-prefix="fab" data-icon="facebook" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M448 56.7v398.5c0 13.7-11.1 24.7-24.7 24.7H309.1V306.5h58.2l8.7-67.6h-67v-43.2c0-19.6 5.4-32.9 33.5-32.9h35.8v-60.5c-6.2-.8-27.4-2.7-52.2-2.7-51.6 0-87 31.5-87 89.4v49.9h-58.4v67.6h58.4V480H24.7C11.1 480 0 468.9 0 455.3V56.7C0 43.1 11.1 32 24.7 32h398.5c13.7 0 24.8 11.1 24.8 24.7z"></path>
                                </svg>
                                <!-- <span class="fab fa-facebook fa-fw mr-1"></span> --><a href="#">Facebook</a></li>
                            <li class="mb-1">
                                <svg class="svg-inline--fa fa-instagram fa-w-14 fa-fw mr-1" aria-hidden="true" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                                </svg>
                                <!-- <span class="fab fa-instagram fa-fw mr-1"></span> --><a href="#">Instagram</a></li>
                            <li class="mb-1">
                                <svg class="svg-inline--fa fa-linkedin fa-w-14 fa-fw mr-1" aria-hidden="true" data-prefix="fab" data-icon="linkedin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"></path>
                                </svg>
                                <!-- <span class="fab fa-linkedin fa-fw mr-1"></span> --><a href="#">LinkedIn</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right side of profile -->
            <div class="col-lg-8 order-lg-2">
                <ul class="nav nav-pills nav-fill" id="tabMenu">
                    <li class="nav-item">
                        <a  data-toggle="tab" href="#profile" class="nav-link active"><b>Profile</b></a>
                    </li>
                    <li class="nav-item">
                        <a  data-toggle="tab" href="#events" class="nav-link"><b>Events</b></a>
                    </li>
                    <li class="nav-item">
                        <a  data-toggle="tab" href="#groups" class="nav-link"><b>Groups</b></a>
                    </li>
                </ul>
                <hr class="my-1">

                <div class="tab-content py-2">
                    <div class="tab-pane active" id="profile">
                        <h5 class="mb-3">Other user info... <i class="fas fa-pen"></i></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    @if ($user->description)
                                        {{$user->description}}
                                    @else
                                        <b>Update your profile so you can tell people more about yourself</b>
                                    @endif
                                </p>
                                <h6><b>Joined</b></h6>
                                   Part of Exter family since  {{ $user->created_at->format('d.m.Y') }}

                                @if($user->user_type)
                                    <a class="btn btn-outline-quest mt-3 mb-2" data-toggle="collapse" href="#collapseGallery" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Check out if this user has a gallery <i class="fas fa-images"></i>
                                    </a>
                                @endif

                            </div>
                            <div class="col-md-6">
                                <h6>Recent badges</h6>
                                <a href="#" class="badge badge-dark badge-pill">html5</a>
                                <a href="#" class="badge badge-dark badge-pill">react</a>
                                <a href="#" class="badge badge-dark badge-pill">codeply</a>
                                <hr>
                                <span class="badge badge-primary"><i class="fa fa-user"></i> 900 Followers</span>
                                <span class="badge badge-success"><i class="fa fa-cog"></i> 43 Forks</span>
                                <span class="badge badge-danger"><i class="fa fa-eye"></i> 245 Views</span>
                            </div>

                            @if($user->user_type && $user->user_gallary)
                                <div class="collapse ml-3" id="collapseGallery">
                                    <h2 class="font-weight-light text-center text-lg-left mt-4 mb-2">Gallery</h2>
                                    <div class="row">
                                        @foreach(json_decode($user->user_gallary) as $pic)
                                            <div class="col-lg-3 col-md-4 col-6">
                                                <a data-fancybox="gallery" href="{{ asset('storage/'.$pic) }}" class="d-block mb-4 h-100">
                                                    <!-- 170 * 120 -->
                                                    <img class="img-thumbnail zoom" src="{{ asset('storage/'.$pic) }}" style="max-width: 100%; min-height: 120px">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="collapse ml-3" id="collapseGallery">
                                    <b>This user has no gallery to show :(</b>
                                </div>
                            @endif


                            <div class="col-md-12 my-5">
                                <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span><i class="fas fa-calendar-alt"></i> Recent Events {{$user->name}} went</h5>
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        @php
                                          $flag = 0;
                                            $occasions = $user->occasions->sortByDesc('end');
                                        @endphp
                                        @foreach($occasions as $event)
                                            @if($loop->iteration > 4)
                                                @break
                                            @endif
                                            @if($event->ended == 'Ended')
                                                @php $flag = 1 @endphp
                                                <tr>
                                                    <td>{{ $event->name }}</td>
                                                    <td>{{ $event->description }}</td>
                                                    <td><b>Event ended:</b> {{ $event->end }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @if(!$flag)
                                            <tr class="text-center">
                                                <td>User hasn't been on any events yet :(</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Here is Events tab -->
                    <div class="tab-pane" id="events">
                        <div class="card text-white bg mb-3 group-card" style="max-width: 50rem; background-color: #d93850">
                            <a href="/events/create" style="color: white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Make a new event</h5>
                                    <p class="card-text"><i class="fas fa-calendar-day fa-3x"></i></p>
                                </div>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pb-3">
                                <div class="card-header border">
                                    <b><i class="fas fa-crown"></i> My Events</b>
                                </div>
                                <ul class="list-group list-group">
                                    @foreach($myEvents as $event)
                                       <li class="list-group-item event-column"> <a href="/events/{{$event->id}}">{{ $event->name}}</a>
                                                <span class="float-right font-weight-bold">
                                                     <form action="/events/{{ $event->id }}" method="POST" style="padding: 0px !important;">
                                                        @method('DELETE')
                                                    <button type="button" class="btn btn-outline-quest2 btn-sm" data-toggle="modal" data-target="#myModal{{$event->id}}">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                    <a href="/events/recreate/{{$event->id}}" class="btn btn-outline-quest2 btn-sm" title="Repeat this event"><i class="fas fa-redo-alt"></i></a>
                                                         @csrf<button type="submit" class="btn btn-outline-quest2 btn-sm" title="Delete this event"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </span>
                                            </li>
                                                @include('occasions.show',  ['occasion' => $event])
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-12 pb-3">
                                <div class="card-header border">
                                    <b><i class="fas fa-calendar-times"></i> Upcoming events you have joined</b>
                                </div>
                                <ul class="list-group list-group">
                                @foreach($user->occasions as $event)
                                    @if($event->ended = 'Upcoming')
                                            <li class="list-group-item list-inline align-items-center event-column"> <a href="/events/{{$event->id}}">{{ $event->name}}</a>
                                            <span class="float-right font-weight-bold">
                                                <p>starts: {{ $event->start->format('M Y') }}
                                                    <i class="fas fa-clock"></i> {{ $event->start->format(' H:i') }}</p>
                                                <p>ends: {{ $event->end->format('M Y') }}
                                                    <i class="fas fa-clock"></i> {{ $event->end->format(' H:i') }}</p>
                                            </span>
                                        </li>
                                    @endif
                                @endforeach
                                </ul>
                            </div>
                            <a class="btn btn-outline-quest2 mt-2 mb-1 ml-3" href="/user/{{$user->id}}/occasion-history" role="button">
                                Check your whole event history <i class="fas fa-align-justify"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Here is Groups tab -->
                    <div class="tab-pane" id="groups">

                        <div class="card text-white bg-primary mb-3 group-card" style="max-width: 50rem;">
                            <div class="card-body text-center" data-toggle="modal" data-target="#addGroupModal">
                                <h5 class="card-title">Make a new group</h5>
                                <p class="card-text"><i class="fas fa-users fa-3x"></i></p>
                            </div>
                        </div>

                        @if(count($user->groups))
                        <div class="mt-4">
                            <h4>List of all your groups</h4>
                        </div>
                        @endif
                        <table class="table table-hover">
                            <tbody>
                            @if(!(count($user->groups)))
                                <div class="text-center">
                                    You dont have any groups...
                                    <p><b>make one and start going on events with your friends</b></p>
                                </div>
                            @endif
                            @foreach($user->groups as $group)
                                @if($group->admin_id == $user->id)
                                    <tr class="admin-row">
                                        <td class="align-middle">
                                            <span class="float-right font-weight-bold">
                                                <form action="/user/{{ $group->id }}" method="POST" style="padding: 0px !important;">
                                                    @method('DELETE')
                                                    @csrf

                                                 <button type="button" id="{{ $group->id }}" name="btnZaModal" class="btn btn-outline-primary btn-sm"
                                                         data-toggle="modal" title="Add a friend to this group" data-target="#addUserToGroup"><i class="fas fa-plus-circle"></i></button>
                                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                 {{ $group->created_at->format('M Y') }}
                                                </form>

                                            </span><i class="fas fa-crown"></i>
                                            <a href="/groups/{{ $group->id }}">{{ $group->name }}</a>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="align-middle">
                                            <span class="float-right font-weight-bold">
                                                 {{ $group->created_at->format('M Y') }}
                                            </span>
                                            <a href="/groups/{{ $group->id }}">{{ $group->name }}</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>



                        <!-- Modal for ADD groups-->
                        <div class="modal fade" id="addGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Make a new group</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="/user/{{ $user->id }}">
                                            <div class="form-group">
                                                <label for="name" class="col-form-label">Group name:</label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter group name:">
                                                <div>{{ $errors->first('name') }}</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description-text" class="col-form-label">Group description:</label>
                                                <textarea class="form-control" name="description" placeholder="Write something that makes your group unique:"></textarea>
                                                <div>{{ $errors->first('description') }}</div>
                                            </div>
                                            <div class="modal-footer" style="padding: 1px">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add Group</button>
                                            </div>
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Here ends modal for adding group -->

                        <!-- Modal for adding user to group -->
                        <div class="modal fade" id="addUserToGroup" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add friend to group:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dodaj osobu</label>
                                            <input class="form-control" type="text" id="user_name" name="name" placeholder="Enter name of a person you want to add to this group" autocomplete="off">
                                            <div id="userList"></div>
                                            <div>{{ $errors->first('name') }}</div>
                                        </div>
                                        <input type="hidden" name="groupId" value="{{ $group->id }}">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <input type="hidden" value="{{csrf_token()}}" name="_token">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" id="addFriend" class="btn btn-primary">Add friend</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Here ends modal for adding User to group -->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
