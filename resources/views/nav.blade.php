<nav class="navbar fixed-top navbar-expand-md navbar--color--ghost py-1 rounded" data-startColor="navbar--color--ghost" data-startSize="py-1" data-intoColor="navbar--color--white" data-intoSize="py-0">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img class="img-fluid" src="{{ asset('/images/logo/logo-transp-sm.png') }}" style="width: 60%; height: auto; overflow: hidden">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <!-- <span style="color: whitesmoke" ><span class="navbar-toggler-icon"></span></span> -->
            <i class="fas fa-angle-double-down fa-2x nav-toggle-icon"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if(\Request::is('events'))
                    <li>
                        <button type="button" id="sidebarCollapse" class="btn btn-outline-quest2">
                            <i class="fas fa-filter"></i>
                        </button>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="/questionary" class="nav-link top"><b>Questionary</b></a>
                </li>
                <li class="nav-item">
                    <a href="/events" class="nav-link top"><b>Events</b></a>
                </li>
                @if(!Auth::guest())
                    <div id="notifyId" class="dropdown-container">
                        <li class="nav-item">
                            <a href="#" class="nav-link notify-button top heartbeat bell" data-toggle="dropdown"><i class="fas fa-bell big-bell">
                                    <span class="badge badge-pill badge-danger" style="margin-left: -2.2px">
                                        {{ count((Auth::user()->unreadNotifications)) }}</span>
                                </i></a>
                                <ul class="dropdown-menu notify-drop">
                                    <div class="notify-drop-title">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6"><b>Notifications ({{ count((Auth::user()->unreadNotifications)) }})</b>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <span id="checkAll" class="float-right checkAll">Check all</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="drop-content">
                                        <ul>
                                            @if(!count(Auth::user()->unreadNotifications))
                                                <b>There are no new notifications :(</b>
                                            @else
                                            @foreach(Auth::user()->unreadNotifications as $notify)
                                                <li>
                                                @if($notify['data']['type'] == 'groups')
                                                    <span class="icon"><i class="fas fa-users"></i></span>
                                                @elseif($notify['data']['type'] == 'follower')
                                                        <span class="icon"><i class="fas fa-arrow-alt-circle-right"></i></span>
                                                @endif
                                                <span class="text">{{ $notify['data']['text'] }}</span>
                                                <p class="check" style="margin-top: 8px; margin-left: 2.5px">
                                                    <button  id="checkButton" name="checkButton" value="{{ $notify['id'] }}" type="button" class="btn btn-outline-success btn-sm">
                                                    <i class="fas fa-check"></i>
                                                    </button>
                                                    <input type="hidden" value="{{csrf_token()}}" name="_tokenCheck">
                                                </p>
                                                </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </ul>
                        </li>
                    </div>
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link top" href="{{ route('login') }}"><b>{{ __('Login') }}</b></a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link top" href="{{ route('register') }}"><b>{{ __('Register') }}</b></a>
                        </li>
                    @endif
                @else

                    <!-- OLD PAR OF NAVBAR -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="/user/{{ Auth::id() }}" class="dropdown-item" style="color: black">
                                <span class="addon"><i class="fas fa-user" style="padding-right: 7px"></i></span>Profile
                            </a>
                            <hr class="my-0">
                            <a href="/user/{{ Auth::id() }}/edit" class="dropdown-item" style="color: black">
                                <span class="addon"><i class="fas fa-sliders-h" style="padding-right: 7px"></i></span>Settings
                            </a>
                            <hr class="my-0">
                            <a class="dropdown-item" href="{{ route('logout') }}" style="color: black"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="addon"><i class="fas fa-sign-out-alt" style="padding-right: 7px"></i></span> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
